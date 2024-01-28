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
            session()->setFlashdata('usernameError', $this->validation->getError('username'));
            session()->setFlashdata('passwordError', $this->validation->getError('password'));
            session()->setFlashdata('confirmError', $this->validation->getError('confirm'));
            session()->setFlashdata('RegisterFailed', 'True');
            return redirect()->back()->withInput();
        }

        $hashedpass = md5($data['password']);
        $defaultprofile = 'default.jpg';
        //jika tdk ada error 
        //masukan data ke database
        $this->UserModel->save([
            'Username' => $data['username'],
            'Password' => $hashedpass,
            'FotoProfil' => $defaultprofile,
        ]);


        $user = $this->UserModel->where('Username', $data['username'])->first();

        $sessLogin = [
            'isLogin' => true,
            'UserID' => $user['UserID'],
            'FotoProfil' => $user['FotoProfil'],
        ];
        $this->session->set($sessLogin);

        //arahkan ke halaman login
        session()->setFlashdata('login', 'Anda berhasil mendaftar, silahkan login');
        //redirect kembali ke page sebelumnya
        return redirect()->back();
        // return redirect()->to('/profile/' . $user['UserID']);
    }

    public function valid_login()
    {
        // Load helper yang diperlukan
        helper(['form', 'url']);
        //ambil data dari form
        $data = $this->request->getPost();

        //ambil data user di database yang usernamenya sama 
        $user = $this->UserModel->where('Username', $data['username'])->first();

        //cek apakah username ditemukan
        if ($user) {
            //cek password
            //jika salah arahkan lagi ke halaman login
            if ($user['Password'] != md5($data['password'])) {
                session()->setFlashdata('LoginFailed', 'True');
                session()->setFlashdata('passwordWrong', 'Password tidak sesuai');


                return redirect()->back()->withInput();
            } else {
                //jika benar, arahkan user masuk ke aplikasi 
                $sessLogin = [
                    'isLogin' => true,
                    'UserID' => $user['UserID'],
                    'FotoProfil' => $user['FotoProfil'],
                ];
                $this->session->set($sessLogin);
                return redirect()->back();
                // return redirect()->to('/profile/' . $user['UserID']);
            }
        } else {

            //kembali ke halaman login sekaligus membuka modal register
            session()->setFlashdata('LoginFailed', 'True');
            session()->setFlashdata('usernameNotFound', 'Username tidak ditemukan');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        //hancurkan session 
        //balikan ke halaman login
        $this->session->destroy();
        return redirect()->to('/');
    }
}
