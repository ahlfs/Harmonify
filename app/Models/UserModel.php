<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "user";
    protected $primaryKey = "UserID";
    protected $allowedFields    = ['UserID', 'Username', 'Password', 'Email', 'NamaLengkap', 'Alamat', 'PhotoProfile', 'Active', 'ActiveExpired', 'ResetToken', 'ResetTokenExpired', 'TemporaryEmail', 'TemporaryEmailToken', 'TemporaryEmailExpired'];

    public function getUser($id = false)
    {
        if ($id == false) {
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
        return $this->like('Username', $keyword)->orLike('NamaLengkap', $keyword)->findAll();
    }

    public function getUserByEmail($email)
    {
        return $this->where(['Email' => $email])->first();
    }

    public function getUserByTemporaryEmail($email)
    {
        return $this->where(['TemporaryEmail' => $email])->first();
    }

    public function getExpiredReset()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->where('ResetTokenExpired <', date('Y-m-d H:i:s'))->findAll();
        foreach ($data as $d) {
                $this->save([
                    'UserID' => $d['UserID'],
                    'ResetToken' => '',
                    'ResetTokenExpired' => '',
                ]);
            }
    }

    public function getExpiredActive()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->where('ActiveExpired <', date('Y-m-d H:i:s'))->findAll();
        foreach ($data as $d) {
            if ($d['Active'] != 'true') {
                $this->delete(['UserID' => $d['UserID']]);
            }
        }
    }

    public function getExpiredEmail()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->where('TemporaryEmailExpired <', date('Y-m-d H:i:s'))->findAll();
        foreach ($data as $d) {
                $this->save([
                    'UserID' => $d['UserID'],
                    'TemporaryEmail' => '',
                    'TemporaryEmailExpired' => '',
                ]);
            }
    }


}
