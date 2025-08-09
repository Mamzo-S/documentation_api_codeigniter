<?php

namespace App\Models;

use CodeIgniter\Model;

class LienModel extends Model {
    protected $table = 'lien';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['base_url'];

}
