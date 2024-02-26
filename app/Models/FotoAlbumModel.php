<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoAlbumModel extends Model
{
    protected $table = "fotoalbum";
    protected $primaryKey = "FotoAlbumID";
    protected $allowedFields    = ['FotoID', 'AlbumID'];


    
    public function getFotoByAlbum($id)
    {
        return $this->where(['AlbumID' => $id])->findAll();
    }
    
}
