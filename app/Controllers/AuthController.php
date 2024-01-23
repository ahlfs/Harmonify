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
        //tangkap data dari form 
        $data = $this->request->getPost();

        //jalankan validasi
        $this->validation->run($data, 'register');

        //cek errornya
        $errors = $this->validation->getErrors();

        //hash password


        //jika ada error kembalikan ke halaman register
        if ($errors) {
            session()->setFlashdata('username', $this->validation->getError('username'));
            session()->setFlashdata('password', $this->validation->getError('password'));
            session()->setFlashdata('confirm', $this->validation->getError('confirm'));
            return redirect()->to('/');
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
        return redirect()->to('/profile/' . $user['UserID']);
    }

    public function valid_login()
    {
        //ambil data dari form
        $data = $this->request->getPost();

        //ambil data user di database yang usernamenya sama 
        $user = $this->UserModel->where('Username', $data['username'])->first();

        //cek apakah username ditemukan
        if ($user) {
            //cek password
            //jika salah arahkan lagi ke halaman login
            if ($user['Password'] != md5($data['password'])) {
                session()->setFlashdata('password', 'Password salah');
              
                $errorLogin = [
                    'hehe' => 1,
                ];
                
                return redirect()->to('/');
                
            } else {
                //jika benar, arahkan user masuk ke aplikasi 
                $sessLogin = [
                    'isLogin' => true,
                    'UserID' => $user['UserID'],
                    'FotoProfil' => $user['FotoProfil'],
                ];
                $this->session->set($sessLogin);
                return redirect()->to('/profile/' . $user['UserID']);
            }
        } else {

            //kembali ke halaman login sekaligus membuka modal register
            session()->setFlashdata('register', 'Username belum terdaftar, silahkan daftar terlebih dahulu');
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
