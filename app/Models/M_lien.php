<?php

namespace App\Models;

use CodeIgniter\Model;

class M_lien extends Model {
    protected $table = 'lien';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['base_url', 'nom_url'];

}