<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function loginform()
    {
        return view('login');
    }

    public function login()
    {
        $userMod = new UserModel();
        $username = $this->request->getPost('username');
        $mdp = $this->request->getPost('mdp');
        $user = $userMod->where('username', $username)->first();

        if ($user) {
            if ($mdp === $user['motdepasse']) {
                session()->set([
                    'prenom' => $user['prenom'],
                    'isLogged' => true,
                ]);
                return redirect()->to(site_url('index'));
            } else {
                return redirect()->back()->with('errorMessage', 'Mot de passe incorrect');
            }
        } else {
            return redirect()->back()->with('errorMessage', 'Utilisateur non trouvé');
        }
    }

    public function logout()
    {
        session()->destroy();
        
        return redirect()->to(site_url('login'));
    }
}
