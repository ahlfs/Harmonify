<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoModel extends Model
{
    protected $allowedFields    = ['FotoID', 'JudulFoto', 'DeskripsiFoto', 'TanggalUnggah', 'LokasiFile', 'AlbumID', 'UserID', 'Url'];
    
}
