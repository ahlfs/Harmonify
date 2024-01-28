<?php

namespace App\Models;

use CodeIgniter\Model;

class LikeModel extends Model
{
    protected $table = "likefoto";
    protected $primaryKey = "LikeID";
    protected $allowedFields    = ['FotoID', 'UserID', 'TanggalLike'];


    
    public function hasUserLikedPost($UserID, $FotoID)
    {
        return $this->where(['UserID' => $UserID, 'FotoID' => $FotoID])->countAllResults() > 0;
    }

    public function getLikeByPost($id)
    {
        return $this->where(['FotoID' => $id])->findAll();
    }

    public function getLikedFoto($id = false)
    {
        if($id == false){
            return $this->findAll();
        }
        $liked = $this->where('UserID', $id)->findAll();
        return $liked;
    }
}
