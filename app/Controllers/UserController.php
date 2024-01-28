<?php

namespace App\Controllers;

use App\Database\Migrations\User;
use App\Models\FotoModel;
use App\Models\UserModel;
use App\Models\KomentarModel;
use App\Models\LikeModel;

class UserController extends BaseController
{
    protected $FotoModel;
    protected $UserModel;
    protected $KomentarModel;
    protected $LikeModel;


    public function __construct()
    {
        $this->FotoModel = new FotoModel();
        $this->UserModel = new UserModel();
        $this->KomentarModel = new KomentarModel();
        $this->LikeModel = new LikeModel();
    }
    public function index(): string
    {
        $foto = $this->FotoModel->getRandomFoto();

        $data = [
            'validation' => \Config\Services::validation(),
            'foto' => $foto,
        ];

        session()->setFlashdata('ActiveHomeNavbar', 'True');
        return view('user/index', $data);
    }

    public function search(): string
    {
        $keyword = $this->request->getVar('keyword');
        $foto = $this->FotoModel->getFotoByKeyword($keyword);
        $akun = $this->UserModel->getUserByKeyword($keyword);

        $data = [
            'validation' => \Config\Services::validation(),
            'foto' => $foto,
            'akun' => $akun,
            'keyword' => $keyword,
        ];

        return view('user/searchresult', $data);
    }

    public function profile($id): string
    {
        $user = $this->UserModel->getUser($id);
        $foto = $this->FotoModel->getCreatedFoto($id);

        $jumlahfoto = count($foto);

        $data = [
            'validation' => \Config\Services::validation(),
            'user' => $user,
            'foto' => $foto,
            'jumlahfoto' => $jumlahfoto,
        ];
        return view('user/profile', $data);
    }

    public function liked($id): string
    {
        $user = $this->UserModel->getUser($id);
        $liked = $this->LikeModel->getLikedFoto($id);
        $foto = [];
        foreach ($liked as $like) {
            $foto[] = $this->FotoModel->getFoto($like['FotoID']);
        }

        $createdfoto = $this->FotoModel->getCreatedFoto($id);
        $jumlahfoto = count($createdfoto);

        $data = [
            'validation' => \Config\Services::validation(),
            'user' => $user,
            'foto' => $foto,
            'jumlahfoto' => $jumlahfoto,

        ];
        return view('user/profileLike', $data);
    }

    public function album($id): string
    {
        $createdfoto = $this->FotoModel->getCreatedFoto($id);
        $jumlahfoto = count($createdfoto);

        $data = [
            'validation' => \Config\Services::validation(),
            'user' => $this->UserModel->getUser($id),
            'jumlahfoto' => $jumlahfoto,
        ];
        return view('user/profileAlbum', $data);
    }

    public function post($id): string
    {
        $userId = session('UserID');
        $fotodata = $this->FotoModel->getFoto($id);
        $user = $this->UserModel->where('UserID', $fotodata['UserID'])->first();
        $komentar = $this->KomentarModel->getKomentarByPost($id);
        $like = $this->LikeModel->getLikeByPost($id);
        $jumlahlike = count($like);
        $liked = $this->LikeModel->hasUserLikedPost($userId, $id);
        $url = $fotodata['Url'];
        //jika $url ada www.instagram.com
        if (strpos($url, 'www.instagram.com') !== false) {
            $url = '<i class="fa-brands fa-square-instagram fa-xl" style="color: #ff306c;"></i> instagram.com';
        }
        //jika $url ada www.facebook.com
        else if (strpos($url, 'www.facebook.com') !== false) {
            $url = '<i class="fa-brands fa-facebook fa-xl" style="color: #4267b2;"></i> facebook.com';
        }
        //jika $url ada www.twitter.com
        else if (strpos($url, 'www.twitter.com') !== false) {
            $url = '<i class="fa-brands fa-twitter fa-xl" style="color: #1da1f2;"></i> twitter.com';
        }
        //jika $url ada www.youtube.com
        else if (strpos($url, 'www.youtube.com') !== false) {
            $url = '<i class="fa-brands fa-youtube fa-xl" style="color: #ff0000;"></i> youtube.com';
        }
        //jika $url ada www.tiktok.com
        else if (strpos($url, 'www.tiktok.com') !== false) {
            $url = '<i class="fa-brands fa-tiktok fa-xl"></i> tiktok.com';
        }
        else {
            $url = '↗ website.com';
        }

        $data = [
            'validation' => \Config\Services::validation(),
            'fotodata' => $fotodata,
            'user' => $user,
            'komentar' => $komentar,
            'jumlahlike' => $jumlahlike,
            'liked' => $liked,
            'url' => $url,
        ];

        return view('user/post', $data);
    }

    public function create(): string
    {
        session()->setFlashdata('ActiveCreateNavbar', 'True');
        return view('user/create');
    }

    public function editprofile($id): string
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'user' => $this->UserModel->getUser($id)
        ];
        return view('user/editprofile', $data);
    }
}
