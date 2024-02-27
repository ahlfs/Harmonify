<?php

namespace App\Models;

use CodeIgniter\Model;

class AlbumModel extends Model
{
    protected $table = "album";
    protected $primaryKey = "AlbumID";
    protected $allowedFields    = ['NamaAlbum', 'DeskripsiAlbum', 'TanggalAlbum', 'UserID'];


    
    public function getAlbumByID($id)
    {
        return $this->where(['UserID' => $id])->findAll();
    }

    public function getAlbumByAlbumID($id)
    {
        return $this->where(['AlbumID' => $id])->find();
    }
    
}
