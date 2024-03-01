<?php

namespace App\Controllers;
use App\Models\FotoModel;
use App\Models\KomentarModel;
use App\Models\LikeModel;
use App\Models\UserModel;
use App\Models\AlbumModel;
use App\Models\FotoAlbumModel;

class PostController extends BaseController
{
    protected $FotoModel;
    protected $KomentarModel;
    protected $LikeModel;
    protected $UserModel;
    protected $AlbumModel;
    protected $FotoAlbumModel;
    protected $session;
    public function __construct()
    {
        $this->FotoModel = new FotoModel();
        $this->KomentarModel = new KomentarModel();
        $this->LikeModel = new LikeModel();
        $this->UserModel = new UserModel();
        $this->AlbumModel = new AlbumModel();
        $this->FotoAlbumModel = new FotoAlbumModel();
        $this->session = \Config\Services::session();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function upload()
    {
        $UserID = session('UserID');
        // ambil gambar
        $fileDokumen = $this->request->getFile('foto');
        $newName = $fileDokumen->getRandomName();
        $fileDokumen->move('image_storage', $newName);



        $this->FotoModel->save([
            "JudulFoto" => $this->request->getVar('JudulFoto'),
            'DeskripsiFoto' => $this->request->getVar('DeskripsiFoto'),
            'TanggalUnggah' => date('Y-m-d'),
            'Url' => $this->request->getVar('Url'),
            'Foto' => $newName,
            'UserID' => $UserID
        ]);

        if ($this->request->getVar('AlbumID') != 0) {
            $foto = $this->FotoModel->where('Foto', $newName)->first();
            $this->FotoAlbumModel->save([
                'FotoID' => $foto['FotoID'],
                'AlbumID' => $this->request->getVar('AlbumID'),
            ]);
        }

        session()->setFlashdata('notifSuccess', 'Post Created');
        return redirect()->to('/');
    }

    public function download($id)
    {
        $dataFile = $this->FotoModel->getFoto($id);
        $fileExtension = pathinfo($dataFile['Foto'], PATHINFO_EXTENSION);
        $NamaFile = $dataFile['JudulFoto'] . '.' . $fileExtension;
        return $this->response->download('image_storage/' . $dataFile['Foto'], null)->setFileName($NamaFile);
    }

    public function komentar($id)
    {
        $UserID = session('UserID');
        $this->KomentarModel->save([
            'FotoID' => $id,
            'UserID' => $UserID,
            "IsiKomentar" => $this->request->getVar('IsiKomentar'),
            'TanggalKomentar' => date('Y-m-d H:i:s'),
        ]);
        return redirect()->to('/post/' . $id);
    }

    public function deletekomentar($id, $creatorID)
    {
        $komentar = $this->KomentarModel->getKomentarByID($id);
        if ($komentar[0]['UserID'] != session('UserID') ) {
            if ($creatorID != session('UserID')) {
                return redirect()->to('/accessdenied');
            }
        }
        $this->KomentarModel->where('KomentarID', $id)->delete();
        return redirect()->to('/post/' . $komentar[0]['FotoID']);
    }

    public function like($id)
    {
        if (session('isLogin') == false) {
            session()->setFlashdata('LoginFailed', 'True');
            session()->setFlashdata('usernameNotFound', 'Oops, you need to login first before like a post');
            return redirect()->back();
        }
        $UserID = session('UserID');
        $this->LikeModel->save([
            'FotoID' => $id,
            'UserID' => $UserID,
            'TanggalLike' => date('Y-m-d'),
        ]);
        return redirect()->to('/post/' . $id);
    }

    public function unlike($id)
    {
        $UserID = session('UserID');
        $this->LikeModel->where('FotoID', $id)->where('UserID', $UserID)->delete();
        return redirect()->to('/post/' . $id);
    }

    

    public function editpost($id)
    {
        $userid = session('UserID');
        $post = $this->FotoModel->getFoto($id);
        if ($post['UserID'] != $userid) {
            return redirect()->to('/accessdenied');
        }
        $data = [
            'validation' => \Config\Services::validation(),
            'foto' => $this->FotoModel->getFoto($id),
        ];
        return view('user/editpost', $data);
    }

    public function updatepost($id)
    {
        $fotoLama = $this->FotoModel->getFoto($id);
        if ("" == $this->request->getFile('foto')) {
            $newName = $fotoLama['Foto'];
        } else {
            $rule_foto = 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]';

            // ambil gambar
        $fileDokumen = $this->request->getFile('foto');
        $newName = $fileDokumen->getRandomName();
        $fileDokumen->move('image_storage', $newName);
        unlink('image_storage/' . $fotoLama['Foto']);
        }

        $this->FotoModel->save([
            "FotoID" => $id,
            "JudulFoto" => $this->request->getVar('JudulFoto'),
            'DeskripsiFoto' => $this->request->getVar('DeskripsiFoto'),
            'AlbumID' => $this->request->getVar('AlbumID'),
            'Url' => $this->request->getVar('Url'),
            'Foto' => $newName,
        ]);

        session()->setFlashdata('pesan', 'Post Succesfully Updated');
        return redirect()->to('/');
    }

    public function deletepost($id)
    {
        $foto = $this->FotoModel->getFoto($id);
        if ($foto['UserID'] != session('UserID')) {
            return redirect()->to('/accessdenied');
        }
        $this->KomentarModel->where('FotoID', $id)->delete();
        $this->LikeModel->where('FotoID', $id)->delete();
        unlink('image_storage/' . $foto['Foto']);
        $this->FotoModel->where('FotoID', $id)->delete();
        session()->setFlashdata('pesan', 'Post Succesfully Deleted');
        return redirect()->to('/profile/' . session('UserID'));
    }

    public function addposttoalbum($fotoid, $albumid)
    {
        if ($albumid == 0) {
            return redirect()->to('/post/' . $fotoid);
        }
        if ($this->FotoAlbumModel->where('FotoID', $fotoid)->where('AlbumID', $albumid)->first()) {
            session()->setFlashdata('posttoalbumFailed', 'Fail');
            return redirect()->to('/post/' . $fotoid);
        }
        $this->FotoAlbumModel->save([
            'FotoID' => $fotoid,
            'AlbumID' => $albumid,
        ]);
        session()->setFlashdata('posttoalbumSuccess', 'Success');
        return redirect()->to('/post/' . $fotoid);
    }
    
}
