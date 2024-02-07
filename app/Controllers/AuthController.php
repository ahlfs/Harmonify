<?php

namespace App\Controllers;

use App\Models\UserModel;





class AuthController extends BaseController
{
    protected $validation;
    protected $UserModel;
    protected $session;


    public function __construct()
    {

        $this->UserModel = new UserModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }
    public function valid_register()
    {
        // Load helper yang diperlukan
        helper(['form', 'url']);
        //tangkap data dari form 
        $data = $this->request->getPost();

        //jalankan validasi
        $this->validation->run($data, 'register');

        //cek errornya
        $errors = $this->validation->getErrors();

        //hash password


        //jika ada error kembalikan ke halaman register
        if ($errors) {
            session()->setFlashdata('usernameError', $this->validation->getError('usernameRegister'));
            session()->setFlashdata('passwordError', $this->validation->getError('passwordRegister'));
            session()->setFlashdata('confirmError', $this->validation->getError('confirmRegister'));
            session()->setFlashdata('emailError', $this->validation->getError('emailRegister'));
            session()->setFlashdata('RegisterFailed', 'True');
            return redirect()->back()->withInput();
        }

        $hashedpass = md5($data['passwordRegister']);
        $defaultprofile = 'default.jpg';
        //jika tdk ada error 
        //masukan data ke database
        $randomToken = $this->getRandomToken();
        $this->UserModel->save([
            'Username' => $data['usernameRegister'],
            'Password' => $hashedpass,
            'Email' => $data['emailRegister'],
            'FotoProfil' => $defaultprofile,
            'Active' => $randomToken,
        ]);

        //arahkan ke halaman login
        $email = \Config\Services::email();
        $alamat = $data['emailRegister'];
        $email->setTo($alamat);
        $email->setSubject('Verifikasi Email');
        $email->setMessage("Klik link berikut untuk verifikasi email: " . base_url("verifyEmail/{$alamat}/{$randomToken}"));

        if ($email->send()) {
            session()->setFlashdata('Email', $data['emailRegister']);
            session()->setFlashdata('EmailVerification', 'True');
            return redirect()->back();
        } else {
            return redirect()->to('/accessdenied');
        }
    }

    public function valid_login()
    {
        // Load helper yang diperlukan
        helper(['form', 'url']);
        //ambil data dari form
        $data = $this->request->getPost();

        //ambil data user di database yang usernamenya sama 
        $user = $this->UserModel->where('Username', $data['usernameLogin'])->first();

        //cek apakah username ditemukan
        if ($user) {
            //cek password
            //jika salah arahkan lagi ke halaman login
            if ($user['Password'] != md5($data['passwordLogin'])) {
                session()->setFlashdata('LoginFailed', 'True');
                session()->setFlashdata('passwordWrong', 'Password tidak sesuai');


                return redirect()->back()->withInput();
            } else {
                if ($user['Active'] != 'true') {
                    session()->setFlashdata('LoginFailed', 'True');
                    session()->setFlashdata('EmailNotVerified', 'Email belum diverifikasi');
                    return redirect()->back()->withInput();
                }
                
                //jika benar, arahkan user masuk ke aplikasi 
                $sessLogin = [
                    'isLogin' => true,
                    'UserID' => $user['UserID'],
                    'FotoProfil' => $user['FotoProfil'],
                ];
                $this->session->set($sessLogin);
                return redirect()->back();
                // return redirect()->to('/profile/' . $user['UserID']);
                // kirim email
            }
        } else {

            //kembali ke halaman login sekaligus membuka modal register
            session()->setFlashdata('LoginFailed', 'True');
            session()->setFlashdata('usernameNotFound', 'Username tidak ditemukan');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        //hancurkan session 
        //balikan ke halaman login
        $this->session->destroy();
        return redirect()->to('/');
    }

    function getRandomToken($length = 32)
    {
        // Membuat karakter acak yang mungkin digunakan dalam token
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $token = '';

        // Menghasilkan token dengan panjang yang diinginkan
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[random_int(0, strlen($characters) - 1)];
        }

        // Menambahkan waktu untuk membuat token lebih unik
        $token .= time();

        return $token;
    }

    public function verifyEmail($email, $token)
    {
        $user = $this->UserModel->getUserByEmail($email);
        if ($user == '') {
            return redirect()->to('/accessdenied');
        }
        
        $this->UserModel->save([
            'UserID' => $user['UserID'],
            'Active' => 'true',
        ]);

        session()->setFlashdata('LoginFailed', 'True');
        session()->setFlashdata('EmailVerified', 'Email berhasil diverifikasi');
        return redirect()->to('/');
    }

   public function forgotpassword()
   {
    $data = $this->request->getPost();
    $user = $this->UserModel->getUserByEmail($data['email']);
    if ($user == '') {
        session()->setFlashdata('Email', $data['email']);
        session()->setFlashdata('EmailVerification', 'True');
        return redirect()->back();
    }
    $randomToken = $this->getRandomToken();
        $this->UserModel->save([
            'UserID' => $user['UserID'],
            'ResetToken' => $randomToken,
        ]);
   
    $email = \Config\Services::email();
    $alamat = $data['email'];
    $email->setTo($alamat);
    $email->setSubject('Verifikasi Email');
    $email->setMessage("Klik link berikut untuk verifikasi email: " . base_url("resetpassword/{$alamat}/{$randomToken}"));

    if ($email->send()) {
        session()->setFlashdata('Email', $data['email']);
        session()->setFlashdata('EmailVerification', 'True');
        return redirect()->back();
    } else {
        return redirect()->to('/accessdenied');
    }
   }

    public function changepassword($id)
    {
     $data = $this->request->getPost();
     $user = $this->UserModel->getUserByID($id);
     if ($user == '') {
          return redirect()->to('/accessdenied');
     }
     $this->validation->run($data, 'resetpassword');
     $errors = $this->validation->getErrors();
     if ($errors) {
          session()->setFlashdata('passwordError', $this->validation->getError('passwordReset'));
          return redirect()->back()->withInput();
     }
     $hashedpass = md5($data['passwordReset']);
     $this->UserModel->save([
          'UserID' => $user['UserID'],
          'Password' => $hashedpass,
     ]);
     return redirect()->to('/');
    }
}
