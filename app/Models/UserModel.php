<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "user";
    protected $primaryKey = "UserID";
    protected $allowedFields    = ['UserID', 'Username', 'Password', 'Email', 'NamaLengkap', 'Alamat', 'FotoProfil'];

    public function getUser($id = false)
    {
        if($id == false){
            return $this->findAll();
        }
        return $this->where(['UserID' => $id])->first();
    }

    public function getUserByKomentar($id)
    {
        return $this->where(['UserID' => $id])->first();
    }
    
    public function getUserByKeyword($keyword)
    {
        return $this->like('Username', $keyword)->orLike('NamaLengkap', $keyword);
    }
}
