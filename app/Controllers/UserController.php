<?php

namespace App\Controllers;

use App\Models\FotoModel;
use App\Models\UserModel;
use App\Models\KomentarModel;
use App\Models\LikeModel;
use App\Models\AlbumModel;

class UserController extends BaseController
{
    protected $FotoModel;
    protected $UserModel;
    protected $KomentarModel;
    protected $LikeModel;
    protected $validation;
    protected $session;
    protected $AlbumModel;


    public function __construct()
    {
        $this->FotoModel = new FotoModel();
        $this->UserModel = new UserModel();
        $this->KomentarModel = new KomentarModel();
        $this->AlbumModel = new AlbumModel();
        $this->LikeModel = new LikeModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        date_default_timezone_set('Asia/Jakarta');
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
        $this->UserModel->getExpiredActive();
        $this->UserModel->getExpiredReset();
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
        $foto = array_reverse($foto);
        $jumlahfoto = count($foto);

        $data = [
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
        $album = $this->AlbumModel->getAlbumByID($id);
        $createdfoto = $this->FotoModel->getCreatedFoto($id);
        $jumlahfoto = count($createdfoto);
        $colorbox = [
            '#0070FF', '#ED1C24', '#57F287', '#FFEB00', '#9E3AC3', '#F88CAE'
        ];
        $i = 0;
        foreach ($album as $f) {
            $album[$i]['colorbox'] = $colorbox[$i % 6];
            $i++;
        }

        $data = [
            'validation' => \Config\Services::validation(),
            'user' => $this->UserModel->getUser($id),
            'jumlahfoto' => $jumlahfoto,
            'album' => $album,
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

    public function create()
    {
        
        $userid = session('UserID');
        $album = $this->AlbumModel->getAlbumByID($userid);
        $data = [
            'album' => $album,
        ];
        session()->setFlashdata('ActiveCreateNavbar', 'True');
        return view('user/create', $data);
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

        if ($data['email'] != $user['Email']) {
            if (!$this->validate([
                'email' => [
                    'rules' => 'is_unique[user.Email]'
                ],
            ])) {
                session()->setFlashdata('usernameError', "Email sudah dipakai");
                return redirect()->back()->withInput();
            }
        }

        $this->validation->run($data, 'updateprofile');

        $errors = $this->validation->getErrors();

        //jika ada error kembalikan ke halaman register
        if ($errors) {
            session()->setFlashdata('usernameError', $this->validation->getError('username'));
            session()->setFlashdata('emailError', $this->validation->getError('email'));
            session()->setFlashdata('photoprofileError', $this->validation->getError('photoprofile'));
            return redirect()->back()->withInput();
        }

        $fileFoto = $user['PhotoProfile'];
        $fileDokumen = $this->request->getFile('photoprofile');
        if ($fileDokumen == "") {
            $namaFoto = $fileFoto;
        } else {
            if ($fileFoto != 'default.jpg') {
                unlink('user_profile/' . $user['PhotoProfile']);
            }
            $namaFoto = $fileDokumen->getRandomName();
            $fileDokumen->move('user_profile', $namaFoto);

            $sessLogin = [
                'isLogin' => true,
                'UserID' => $user['UserID'],
                'PhotoProfile' => $namaFoto,
            ];
            $this->session->set($sessLogin);
        }
        $this->UserModel->save([
            "UserID" => $id,
            "Username" => $data['username'],
            'Email' =>  $data['email'],
            'NamaLengkap' =>  $data['namalengkap'],
            'Alamat' =>  $data['alamat'],
            'PhotoProfile' => $namaFoto,
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

    public function addalbum()
    {
        return view('user/addalbum');
    }

    public function submitalbum()
    {
        $UserID = session('UserID');
        $post = $this->request->getPost();
        $NamaAlbum = $this->request->getVar('NamaAlbum');
        log_message('debug', 'Nama Album: ' . $NamaAlbum);

        $this->AlbumModel->save([
            "NamaAlbum" => $NamaAlbum,
            'DeskripsiAlbum' => $post['DeskripsiAlbum'],
            'TanggalAlbum' => date('Y-m-d'),
            'UserID' => $UserID
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/profile/' . $UserID . '/album');
    }

    public function viewalbum($id)
    {
        $album = $this->AlbumModel->getAlbumByID($id);
        $foto = $this->FotoModel->getFotoByAlbum($id);
        $jumlahfoto = count($foto);

        $data = [
            'validation' => \Config\Services::validation(),
            'user' => $this->UserModel->getUser($id),
            'jumlahfoto' => $jumlahfoto,
            'album' => $album,
            'foto' => $foto,
        ];
        return view('user/viewalbum', $data);
    }
}
