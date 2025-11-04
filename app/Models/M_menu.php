<?php

namespace App\Models;

use CodeIgniter\Model;

class M_menu extends Model {
    protected $table = 'menu';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['code', 'libelle', 'etat'];

}