<?php

namespace App\Models;

use CodeIgniter\Model;

class FormatModel extends Model {
    protected $table = 'format';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['format'];

}
