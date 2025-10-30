<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nom', 'prenom', 'email', 'motdepasse', 'username', 'profile_id', 'statut'];

    public function AfficherUser()
    {
        $req = "SELECT user.id, nom, prenom, email, username, statut, motdepasse, profile_id, profil.profile_name AS profils
                FROM user
                JOIN profil ON user.profile_id=profil.id";
        $query = $this->db->query($req);
        return $query->getResultArray();
    }

    public function getUserByUsername($username, $mdp)
    {
        $user = $this->select('user.*, profil.profile_name AS profils')
            ->join('profil', 'profil.id = user.profile_id')
            ->where('user.username', $username)
            ->first();

        if ($user && password_verify($mdp, $user['motdepasse'])) {
            return $user;
        }

    return null;
    }
}