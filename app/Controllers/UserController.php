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
    protected $validation;
    protected $session;


    public function __construct()
    {
        $this->FotoModel = new FotoModel();
        $this->UserModel = new UserModel();
        $this->KomentarModel = new KomentarModel();
        $this->LikeModel = new LikeModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }
    public function index(): string
    {
        $db = \Config\Database::connect(); // Mendapatkan objek database
        $sql = "SELECT * FROM foto JOIN user ON foto.UserID = user.UserID ORDER BY RAND()";
        $query = $db->query($sql);
        $foto = $query->getResult();
        $foto = json_decode(json_encode($foto), true);
        $data = [
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
        $db = \Config\Database::connect(); // Mendapatkan objek database
        $sql = "SELECT * FROM komentarfoto JOIN user ON komentarfoto.UserID = user.UserID ORDER BY komentarfoto.TanggalKomentar";
        $query = $db->query($sql);
        $komentar = $query->getResult();
        $komentar = json_decode(json_encode($komentar), true);
        $komentar = array_filter($komentar, function ($var) use ($id) {
            return ($var['FotoID'] == $id);
        });


        $userId = session('UserID');
        $fotodata = $this->FotoModel->getFoto($id);
        $user = $this->UserModel->where('UserID', $fotodata['UserID'])->first();
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
        } else {
            $url = '↗ website.com';
        }

        $data = [
            'validation' => \Config\Services::validation(),
            'fotodata' => $fotodata,
            'komentar' => $komentar,
            'user' => $user,
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

    public function editprofile($id)
    {
        if (session('UserID') != $id) {
            return redirect()->to('/accessdenied');
        }
        $data = [
            'validation' => \Config\Services::validation(),
            'user' => $this->UserModel->getUser($id)
        ];
        return view('user/editprofile', $data);
    }

    public function updateprofile($id)
    {
        $data = $this->request->getPost();
        $user = $this->UserModel->getUser($id);
        if ($data['username'] != $user['Username']) {
            if (!$this->validate([
                'username' => [
                    'rules' => 'is_unique[user.Username]'
                ],
            ])) {
                session()->setFlashdata('usernameError', "Username sudah dipakai");
                return redirect()->back()->withInput();
            }
        }

        $this->validation->run($data, 'updateprofile');

        $errors = $this->validation->getErrors();

        //jika ada error kembalikan ke halaman register
        if ($errors) {
            session()->setFlashdata('usernameError', $this->validation->getError('username'));
            session()->setFlashdata('emailError', $this->validation->getError('email'));
            session()->setFlashdata('fotoprofileError', $this->validation->getError('fotoprofile'));
            return redirect()->back()->withInput();
        }

        $fileFoto = $user['FotoProfil'];
        $fileDokumen = $this->request->getFile('fotoprofile');
        if ($fileDokumen == "") {
            $namaFoto = $fileFoto;
        } else {
            if ($fileFoto != 'default.jpg') {
                unlink('user_profile/' . $user['FotoProfil']);
            }
            $namaFoto = $fileDokumen->getRandomName();
            $fileDokumen->move('user_profile', $namaFoto);

            $sessLogin = [
                'isLogin' => true,
                'UserID' => $user['UserID'],
                'FotoProfil' => $namaFoto,
            ];
            $this->session->set($sessLogin);
        }
        $this->UserModel->save([
            "UserID" => $id,
            "Username" => $data['username'],
            'Email' =>  $data['email'],
            'NamaLengkap' =>  $data['namalengkap'],
            'Alamat' =>  $data['alamat'],
            'FotoProfil' => $namaFoto,
        ]);
        return redirect()->to('/profile/' . $id);
    }

    public function accessdenied()
    {
        return view('user/accessdenied');
    }

    public function deleteaccount($id)
    {
        $user = $this->UserModel->getUser($id);
        if ($user['UserID'] != session('UserID')) {
            return redirect()->to('/accessdenied');
        }
        $this->KomentarModel->where('UserID', $id)->delete();
        $this->LikeModel->where('UserID', $id)->delete();
        $this->FotoModel->where('UserID', $id)->delete();
        $this->UserModel->where('UserID', $id)->delete();
        session()->destroy();
        return redirect()->to('/');
    }
}
