<?php

namespace App\Controllers;

use App\Database\Migrations\User;
use App\Models\FotoModel;
use App\Models\UserModel;
use App\Models\KomentarModel;

class UserController extends BaseController
{
    protected $FotoModel;
    protected $UserModel;
    protected $KomentarModel;


    public function __construct()
    {
        $this->FotoModel = new FotoModel();
        $this->UserModel = new UserModel();
        $this->KomentarModel = new KomentarModel();
    }
    public function index(): string
    {
        $foto = $this->FotoModel->getRandomFoto();

        $data = [
            'validation' => \Config\Services::validation(),
            'foto' => $foto,
        ];

        return view('user/index', $data);
    }

    public function profile($id): string
    {
        $user = $this->UserModel->getUser($id);
        $UserID =  $user['UserID'];
        $foto = $this->FotoModel->getCreatedFoto($UserID);

        $data = [
            'validation' => \Config\Services::validation(),
            'user' => $user,
            'foto' => $foto,
        ];
        return view('user/profile', $data);
    }

    public function liked($id): string
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'user' => $this->UserModel->getUser($id)
        ];
        return view('user/profileLike', $data);
    }

    public function album($id): string
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'user' => $this->UserModel->getUser($id)
        ];
        return view('user/profileAlbum', $data);
    }

    public function post($id): string
    {
        $fotodata = $this->FotoModel->getFoto($id);
        $user = $this->UserModel->where('UserID', $fotodata['UserID'])->first();
        $komentar = $this->KomentarModel->getKomentarByPost($id);
        $komentaruser = [];
        foreach ($komentar as $komentarItem) {
            $komentaruser[] = $this->UserModel->getUserByKomentar($komentarItem['UserID']);
        }
        $data = [
            'validation' => \Config\Services::validation(),
            'fotodata' => $fotodata,
            'user' => $user,
            'komentar' => $komentar,
            'komentaruser' => $komentaruser,
        ];

        return view('user/post', $data);
    }

    public function create(): string
    {
        return view('user/create');
    }
}
