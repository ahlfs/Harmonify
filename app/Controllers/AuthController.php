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
        date_default_timezone_set('Asia/Jakarta');
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
      
        $randomToken = $this->getRandomToken();
        $expired = date('Y-m-d H:i:s', strtotime('+1 day', strtotime(date('Y-m-d H:i:s'))));
        $this->UserModel->save([
            'Username' => $data['usernameRegister'],
            'Password' => $hashedpass,
            'Email' => $data['emailRegister'],
            'PhotoProfile' => $defaultprofile,
            'Active' => $randomToken,
            'ActiveExpired' => $expired,
        ]);

        $email = \Config\Services::email();
        $alamat = $data['emailRegister'];
        $email->setTo($alamat);
        $email->setSubject('Verifikasi Email');
        $message = "<html><body>
    <p>Hi {$data['usernameRegister']},</p>
    <p style='font-weight: bold;'>We're happy you signed up for Harmonify. To start exploring more further,<br>please confirm that this is your email address.</p>
    <p>To verify your email, click on the button below</p>
    <a href='" . base_url("verify/email/{$alamat}/{$randomToken}") . "'><button style='font-size: 17px; font-weight: bold; color: white; border: transparent; padding: 0.5em 2em; background: linear-gradient(to right top, #d16ba5, #c777b9, #ba83ca, #aa8fd8, #9a9ae1, #8aa7ec, #79b3f4, #69bff8, #52cffe, #41dfff, #46eefa, #5ffbf1); border-radius: 4px;'>Verify</button></a><br>
    <p style='font-size: 14px;'>Welcome to Harmonify!</p>
    <p>If this isn't you who signed up, please ignore this email. This link is only valid for the next 24 hours.</p><br>
    <p style='font-style: italic;'>Thanks,<br>The Harmonify Team</p>
    </body></html>";
        $email->setMessage($message);

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
                    'PhotoProfile' => $user['PhotoProfile'],
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

    public function testo()
    {
       return view('user/testo');
    }

    function getRandomToken($length = 32)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = '';
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[random_int(0, strlen($characters) - 1)];
        }
        $token .= time();

        return $token;
    }

    public function verifyEmail($email, $token)
    {
        $this->UserModel->getExpiredActive();

        $user = $this->UserModel->getUserByEmail($email);
        if ($user == '') {
            return redirect()->to('/accessdenied');
        }
        if ($user['Active'] != $token) {
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
            session()->setFlashdata('Email', "Email tidak terdaftar");
            session()->setFlashdata('EmailVerification', 'True');
            return redirect()->back();
        }
        $today = date('Y-m-d H:i:s');
        $expired = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($today)));
        
        $randomToken = $this->getRandomToken();
        $this->UserModel->save([
            'UserID' => $user['UserID'],
            'ResetToken' => $randomToken,
            'ResetTokenExpired' => $expired,
        ]);

        $email = \Config\Services::email();
        $alamat = $data['email'];
        $email->setTo($alamat);
        $email->setSubject('Verifikasi Email');
        $message = "
    <html><body>
    <p>Hi {$user['Username']},</p>
    <p style='font-weight: bold;'>Forgot your password?<br>We receveived a request to reset the password from your account</p>
    <p>To reset your password, click on the button below</p>
    <a href='" . base_url("verify/resetpassword/{$alamat}/{$randomToken}") . "'><button style='font-size: 17px; font-weight: bold; color: white; border: transparent; padding: 0.5em 2em; background: linear-gradient(to right top, #d16ba5, #c777b9, #ba83ca, #aa8fd8, #9a9ae1, #8aa7ec, #79b3f4, #69bff8, #52cffe, #41dfff, #46eefa, #5ffbf1); border-radius: 4px;'>Reset Password</button></a><br>
    <p>If you did not request a password reset, please ignore this email. This link is only valid for the next 24 hours.</p><br>
    <p style='font-style: italic;'>Thanks,<br>The Harmonify Team</p>
    </body></html>";
        $email->setMessage($message);

        if ($email->send()) {
            session()->setFlashdata('Email', $data['email']);
            session()->setFlashdata('EmailVerification', 'True');
            return redirect()->back();
        } else {
            return redirect()->to('/accessdenied');
        }
    }

    public function verifyResetPassword($email, $token)
    {
        $this->UserModel->getExpiredReset();
        $user = $this->UserModel->getUserByEmail($email);
        if ($user == '') {
            return redirect()->to('/accessdenied');
        } elseif ($user['ResetToken'] != $token) {
            return redirect()->to('/accessdenied');
        }
        $data = [
            'user' => $user,
        ];

        return view('user/resetpassword', $data);
    }

    public function resetpassword($id)
    {
        $data = $this->request->getPost();
        $user = $this->UserModel->getUser($id);
        if ($user == '') {
            return redirect()->to('/accessdenied');
        }
        $this->validation->run($data, 'resetpassword');
        $errors = $this->validation->getErrors();
        if ($errors) {
            session()->setFlashdata('passwordError', $this->validation->getError('passwordReset'));
            return redirect()->back()->withInput();
        }
        $hashedpass = md5($data['password']);
        $this->UserModel->save([
            'UserID' => $user['UserID'],
            'Password' => $hashedpass,
            'ResetToken' => null,
            'ResetTokenExpired' => null,
        ]);
        session()->setFlashdata('LoginFailed', 'True');
        session()->setFlashdata('EmailVerified', 'Password berhasil diubah');
        return redirect()->to('/');
    }
}
