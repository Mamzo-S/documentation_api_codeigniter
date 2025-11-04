<?php

namespace App\Models;

use CodeIgniter\Model;

class M_format extends Model {
    protected $table = 'format';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['format'];

}