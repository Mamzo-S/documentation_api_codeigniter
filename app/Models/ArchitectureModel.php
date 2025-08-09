<?php

namespace App\Models;

use CodeIgniter\Model;

class ArchitectureModel extends Model {
    protected $table = 'architecture';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['architecture_name', 'format_donnee', 'header'];

    public function AfficherArchitecture(){
        $req = "SELECT architecture.id, architecture_name, format.format as format_donnees, 
        header FROM architecture INNER JOIN format ON architecture.format_donnee = format.id";
        $query = $this->db->query($req);
        return $query->getResultArray();
    }
}
