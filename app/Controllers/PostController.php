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

        if (!$this->validate([
            'JudulFoto' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul laporan harus diisi'
                ]
            ],
            'DeskripsiFoto' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi laporan harus diisi'
                ]
            ],
            'Url' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lokasi laporan harus diisi'
                ]
            ],
            'Foto' => [
                'rules' => 'max_size[Foto,10240]|is_image[Foto]|mime_in[Foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran file harus kurang dari 10MB',
                    'is_image' => 'File harus berupa gambar',
                    'mime_in' => 'File harus berupa gambar'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();
            session()->setFlashdata('vall', $validation->listErrors());

            return redirect()->back()->withInput();
        }

        // ambil gambar
        $fileDokumen = $this->request->getFile('Foto');
        $newName = $fileDokumen->getRandomName();
        $fileDokumen->move('Foto_storage', $newName);

       

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

    public function tmpUpload(Request $request)
    {
        $fileDokumen = $this->request->getFile('Foto');
        $fileName = $fileDokumen->getName();
        return $fileName;
    }
}
