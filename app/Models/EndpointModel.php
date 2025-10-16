<?php

namespace App\Models;

use CodeIgniter\Model;

class EndpointModel extends Model
{
    protected $table = 'endpoints';
    protected $primaryKey = 'id';

    protected $allowedFields = ['titre', 'lien_end', 'parametre', 'methode_end', 'reponse', 'type', 'endName'];

    public function AfficherEndpoints()
    {
        $req = "SELECT endpoints.id, endpoints.titre, endpoints.lien_end, type, endName, 
                    endpoints.methode_end, lien.base_url AS liens, 
                    parametre, methode.methode_name AS methode, reponse
                FROM endpoints
                JOIN lien ON endpoints.lien_end=lien.id
                JOIN methode ON endpoints.methode_end=methode.id";
        $query = $this->db->query($req);
        return $query->getResultArray();
    }
}
