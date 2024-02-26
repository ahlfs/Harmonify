<?php

namespace App\Controllers;

use App\Models\FotoModel;
use App\Models\UserModel;
use App\Models\KomentarModel;
use App\Models\LikeModel;
use App\Models\AlbumModel;
use App\Models\FotoAlbumModel;
use CodeIgniter\I18n\Time;


class UserController extends BaseController
{
    protected $Carbon;
    protected $FotoModel;
    protected $UserModel;
    protected $KomentarModel;
    protected $LikeModel;
    protected $validation;
    protected $session;
    protected $AlbumModel;
    protected $FotoAlbumModel;


    public function __construct()
    {
        $this->FotoModel = new FotoModel();
        $this->UserModel = new UserModel();
        $this->KomentarModel = new KomentarModel();
        $this->AlbumModel = new AlbumModel();
        $this->FotoAlbumModel = new FotoAlbumModel();
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
        $foto = array_reverse($foto);

        $createdfoto = $this->FotoModel->getCreatedFoto($id);
        //reverse array

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

        $i = 0;
        foreach ($album as &$a) {
            $colors = array("#ffb3ba", "#ffdbfa", "#baffc9", "#e3b7d2", "#bae1ff", "#c9c9ff", "#f1cbff", "#6BCEEE");
            $a['color'] = $colors[$i];
            $i++;
            if ($i == 8) {
                $i = 0;
            }
            $foto = $this->FotoAlbumModel->getFotoByAlbum($a['AlbumID']);
            if (!empty($foto)) {
                $foto_pertama = $this->FotoModel->getFoto($foto[0]['FotoID']);
                $a['foto'] = $foto_pertama['Foto'];
            }
            else {
                $a['foto'] = 'false';
            }
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
        $album = $this->AlbumModel->getAlbumByID($userId);
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

        foreach ($komentar as &$k) {
            $time = Time::parse($k['TanggalKomentar']);
            $ago = $time->humanize();
            $k['TanggalKomentar'] = $ago;
        }

        $data = [
            'validation' => \Config\Services::validation(),
            'fotodata' => $fotodata,
            'komentar' => $komentar,
            'user' => $user,
            'jumlahlike' => $jumlahlike,
            'liked' => $liked,
            'url' => $url,
            'album' => $album,
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
        session()->setFlashdata('notifSuccess', 'Profile Edited Successfully');
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

    public function submitalbum($albumname)
    {
        $UserID = session('UserID');

        $this->AlbumModel->save([
            "NamaAlbum" => $albumname,
            'TanggalAlbum' => date('Y-m-d'),
            'UserID' => $UserID
        ]);

        session()->setFlashdata('notifSuccess', 'Album Created Successfully');
        return redirect()->back();
    }

    public function viewalbum($id)
    {
        $album = $this->AlbumModel->getAlbumByID($id);
        $albumfoto = $this->FotoAlbumModel->getFotoByAlbum($id);
        $foto = [];
        foreach ($albumfoto as $a) {
            $foto[] = $this->FotoModel->getFoto($a['FotoID']);
        }
        $foto = array_reverse($foto);
        $jumlahfoto = count($foto);

        $data = [
            'validation' => \Config\Services::validation(),
            'jumlahfoto' => $jumlahfoto,
            'album' => $album,
            'foto' => $foto,
        ];
        return view('user/viewalbum', $data);
    }

    public function changepassword()
    {
        if (session('isLogin') == false) {
            return redirect()->to('/accessdenied');
        }
        $data = [
            'validation' => \Config\Services::validation(),
            'user' => $this->UserModel->getUser(session('UserID')),
        ];
        return view('user/changepassword', $data);
    }

    public function changepasswordsubmit($id)
    {
        $user = $this->UserModel->getUser($id);

        if (session('UserID') != $user['UserID']) {
            return redirect()->to('/accessdenied');
        }

        $data = $this->request->getPost();
        $this->validation->run($data, 'changepassword');
        $errors = $this->validation->getErrors();
        if ($errors) {
            session()->setFlashdata('newpasswordError', $this->validation->getError('newpassword'));
            session()->setFlashdata('confirmError', $this->validation->getError('confirm'));
            return redirect()->back()->withInput();
        }

        if (md5($data['password']) != $user['Password']) {
            session()->setFlashdata('passwordError', 'Password incorrect!');
            return redirect()->back()->withInput();
        }

        $hashedpass = md5($data['newpassword']);

        $this->UserModel->save([
            "UserID" => $id,
            "Password" => $hashedpass,
        ]);
        session()->setFlashdata('notifSuccess', 'Password Changed Successfully');
        return redirect()->to('/profile/' . $id);
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


    public function changeemail()
    {
        if (session('isLogin') == false) {
            return redirect()->to('/accessdenied');
        }
        $data = [
            'user' => $this->UserModel->getUser(session('UserID')),
        ];
        return view('user/changeemail', $data);
    }

    public function changeemailsubmit($id)
    {
        $user = $this->UserModel->getUser($id);

        if (session('UserID') != $user['UserID']) {
            return redirect()->to('/accessdenied');
        }

        $data = $this->request->getPost();

        if (!$this->validate([
            'newemail' => [
                'rules' => 'is_unique[user.Email]'
            ],
        ])) {
            session()->setFlashdata('emailError', "Email already used!");
            return redirect()->back()->withInput();
        }
        $randomToken = $this->getRandomToken();
        $this->UserModel->save([
            "UserID" => $id,
            "TemporaryEmail" => $data['newemail'],
            "TemporaryEmailToken" => $randomToken,
            "TemporaryEmailExpired" => date('Y-m-d H:i:s', strtotime('+1 day')),
        ]);

        $user = $this->UserModel->getUser($id);
        $email = \Config\Services::email();
        $alamat = $user['TemporaryEmail'];
        $email->setTo($alamat);
        $email->setSubject('Verifikasi Email');
        $message = "
    <html><body>
    <p>Hi {$user['Username']},</p>
    <p style='font-weight: bold;'>Change your email?<br>We receveived a request to change this account to your email</p>
    <p>To change your email from {$user['Email']} to {$user['TemporaryEmail']}, click on the button below</p>
    <a href='" . base_url("/verify/changeemail/{$alamat}/{$randomToken}") . "'><button style='font-size: 17px; font-weight: bold; color: white; border: transparent; padding: 0.5em 2em; background: linear-gradient(to right top, #d16ba5, #c777b9, #ba83ca, #aa8fd8, #9a9ae1, #8aa7ec, #79b3f4, #69bff8, #52cffe, #41dfff, #46eefa, #5ffbf1); border-radius: 4px;'>Change</button></a><br>
    <p>If you did not request an email change, please ignore this email. This link is only valid for the next 24 hours.</p><br>
    <p style='font-style: italic;'>Thanks,<br>The Harmonify Team</p>
    </body></html>";
        $email->setMessage($message);

        if ($email->send()) {
            session()->setFlashdata('notifSuccess', 'Email Verification Sent');
            return redirect()->back();
        } else {
            return redirect()->to('/accessdenied');
        }
    }

    public function verifyChangeEmail($email, $token)
    {
        $this->UserModel->getExpiredEmail();
        $user = $this->UserModel->getUserByTemporaryEmail($email);

        if ($user == '') {
            return redirect()->to('/accessdenied');
        } elseif ($user['TemporaryEmailToken'] != $token) {
            return redirect()->to('/accessdenied');
        } elseif ($user['TemporaryEmailExpired'] < date('Y-m-d H:i:s')) {
            return redirect()->to('/accessdenied');
        } else {
            $this->UserModel->save([
                "UserID" => $user['UserID'],
                "Email" => $user['TemporaryEmail'],
                "TemporaryEmail" => '',
                "TemporaryEmailToken" => '',
                "TemporaryEmailExpired" => NULL,
            ]);
            session()->setFlashdata('notifSuccess', 'Email Changed Successfully');
            return redirect()->to('/profile/' . $user['UserID']);
        }
    }
}
