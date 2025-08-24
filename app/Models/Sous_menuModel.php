<?php

namespace App\Models;

use CodeIgniter\Model;

class Sous_menuModel extends Model {
    protected $table = 'sous_menu';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['code', 'id_menu', 'etat', 'libelle'];

    public function AfficherSous_menu()
    {
        $req = "SELECT sous_menu.id, sous_menu.code, sous_menu.libelle, sous_menu.etat, menu.libelle AS menus
                FROM sous_menu
                JOIN menu ON sous_menu.id_menu = menu.id";
        $query = $this->db->query($req);
        return $query->getResultArray();
    }

    public function getSousMenuByIdMenu($idMenu){
        return $this->select('sous_menu.*')
            ->where('sous_menu.id_menu', $idMenu)
            ->findAll();
    }
}
