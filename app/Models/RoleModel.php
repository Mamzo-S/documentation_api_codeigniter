<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'id';

    protected $allowedFields = ['d_read', 'd_add', 'd_del', 'd_upd', 'profil_id', 'id_sousmenu'];

    public function getRole($id)
    {
        $req = "SELECT role.* , sous_menu.libelle AS smenu, profil.profile_name AS profil
                FROM role
                JOIN sous_menu ON role.id_sousmenu = sous_menu.id
                JOIN profil ON role.profil_id = profil.id where role.profil_id = ?";
        $query = $this->db->query($req, [$id]);
        return $query->getResultArray();
    }
}
