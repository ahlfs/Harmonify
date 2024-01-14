<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Controllers\TemporaryController;

class TemporaryModel extends Model
{
    protected $fillable    = ['folder', 'gambar', 'image'];
    
}
