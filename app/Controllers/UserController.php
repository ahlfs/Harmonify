<?php

namespace App\Controllers;
use App\Models\FotoModel;

class UserController extends BaseController
{
    protected $FotoModel;

    public function __construct()
    {
        $this->FotoModel = new FotoModel();
    }
    public function index(): string
    {
        $foto = $this->FotoModel->getRandomFoto();
        $data = [
            'title' => 'Validasi Pengaduan',
            'validation' => \Config\Services::validation(),
            'foto' => $foto
        ]; 

        return view('user/index', $data);
    }

    public function profile(): string
    {
        return view('user/profile');
    }
    public function saved(): string
    {
        return view('user/profileSecondary');
    }

    public function post($id): string
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'fotodata' => $this->FotoModel->getFoto($id)
        ];

        return view('user/post', $data);
    }

    public function create(): string
    {
        return view('user/create');
    }
}
