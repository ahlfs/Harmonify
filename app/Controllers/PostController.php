<?php

namespace App\Controllers;
use App\Models\Temporary;
use App\Models\FotoModel;
use CodeIgniter\HTTP\Request;

class PostController extends BaseController
{
    protected $FotoModel;
    public function __construct()
    {
        $this->FotoModel = new FotoModel();
    }

    public function upload()
    {
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
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/');
    }
}
