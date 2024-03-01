<?php

namespace App\Models;

use CodeIgniter\Model;

class KomentarModel extends Model
{
    protected $table = "komentarfoto";
    protected $primaryKey = "KomentarID";
    protected $allowedFields    = ['FotoID', 'UserID', 'IsiKomentar', 'TanggalKomentar'];


    
    public function getKomentarByPost($id)
    {
        return $this->where(['FotoID' => $id])->findAll();
    }

    public function getKomentarByID($id)
    {
        return $this->where(['KomentarID' => $id])->findAll();
    }
    
}
