<?php

namespace App\Controllers;
use App\Models\FotoModel;
use App\Models\KomentarModel;

class PostController extends BaseController
{
    protected $FotoModel;
    protected $KomentarModel;
    public function __construct()
    {
        $this->FotoModel = new FotoModel();
        $this->KomentarModel = new KomentarModel();
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

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
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
            'TanggalKomentar' => date('Y-m-d'),
        ]);
        return redirect()->to('/post/' . $id);
    }
}
