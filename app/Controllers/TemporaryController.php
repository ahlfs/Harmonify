<?php

namespace App\Controllers;
use App\Models\TemporaryModel;
use App\Models\FotoModel;


class TemporaryController extends BaseController
{
    protected $FotoModel;
    protected $TmpImageModel;
    public function __construct()
    {
        $this->FotoModel = new FotoModel();
    }
    public function create()
    {
        
        $request = service('request');
        $image = $request->getFile('image');
        $filename = $image->getClientName();
        $folder = uniqid('image-', true);
        $image->store('/tmpimage' . $folder, $filename);

        
        $data = [
            'folder' => $folder,
            'gambar' => $filename
        ];
        $TmpImageModel = new TemporaryModel();

        $TmpImageModel->insert($data);

        return $TmpImageModel->getInsertID();
    }

    function load() {
        $request = service('request');
    }

    public function delete()
    {
        $request = service('request');
        $folder = $request->getBody(); // Assuming folder information is sent in the request body

        $tmpImageModel = new TemporaryModel();
        $tmpImage = $tmpImageModel->where('folder', $folder)->first();

        if ($tmpImage) {
            $path = WRITEPATH . 'uploads/images/tmp/' . $tmpImage->folder;

            // Use rmdir to delete the directory
            if (is_dir($path)) {
                rmdir($path);
            }

        $tmpImageModel->delete($tmpImage->id);
    }
    }
}
