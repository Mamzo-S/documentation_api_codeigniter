<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthentificationModel extends Model
{
    protected $table = 'authentification';
    protected $primaryKey = 'id';

    protected $allowedFields = ['methode_auth', 'lien_auth', 'body'];

    public function AfficherAuthentification()
    {
        $req = "SELECT authentification.id, 
                   authentification.methode_auth, 
                   authentification.lien_auth,
                   lien.base_url AS liens, 
                   methode.methode_name AS methode, 
                   authentification.body
            FROM authentification 
            JOIN lien ON authentification.lien_auth = lien.id 
            JOIN methode ON authentification.methode_auth = methode.id";
        $query = $this->db->query($req);
        return $query->getResultArray();
    }
}
