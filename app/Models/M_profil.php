<?php

namespace App\Models;

use CodeIgniter\Model;

class M_profil extends Model {
    protected $table = 'profil';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['profile_name'];

}