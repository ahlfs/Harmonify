<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoModel extends Model
{
    protected $table = "foto";
    protected $primaryKey = "FotoID";
    protected $allowedFields    = ['FotoID', 'JudulFoto', 'DeskripsiFoto', 'TanggalUnggah', 'LokasiFile', 'AlbumID', 'UserID', 'Url', 'Foto'];

    public function getFoto($id = false)
    {
        if($id == false){
            return $this->findAll();
        }
        return $this->where(['FotoID' => $id])->first();
    }
    public function getRandomFoto()
    {
        return $this->orderBy('FotoID', 'RANDOM')->findAll();
    }

    public function getCreatedFoto($UserID)
    {
        return $this->where('UserID', $UserID)->findAll();
    }

    public function getFotoByAlbum($AlbumID)
    {
        return $this->where('AlbumID', $AlbumID)->findAll();
    }

    public function getFotoByKeyword($keyword)
    {
        return $this->like('JudulFoto', $keyword)->orLike('DeskripsiFoto', $keyword)->findAll();
    }
    
    
}
