<?php

namespace App\Controllers;

use App\Models\ProfilModel;
use App\Models\UserModel;
use App\Models\RoleModel;

class UserController extends BaseController
{
    public function loginform()
    {
        return view('login');
    }

    public function AfficherUser()
    {
        $profMod = new ProfilModel();
        $userMod = new UserModel();
        $donnee['profil'] = $profMod->findAll();
        $donnee['user'] = $userMod->AfficherUser();
        return view('gestionUtilisateur', $donnee);
    }

    public function AjoutUser()
    {

        $nom = $this->request->getPost('nom');
        $prenom = $this->request->getPost('prenom');
        $email = $this->request->getPost('email');
        $username = $this->request->getPost('username');
        $mdp = $this->request->getPost('mdp');
        $profile = $this->request->getPost('profile');
        $userMod = new UserModel();
        $donnee = [
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'username' => $username,
            'motdepasse' => $mdp,
            'profile_id' => $profile
        ];
        $userMod->insert($donnee);
        return redirect()->to(site_url('gestionUtilisateur'));
    }

    public function EditUser()
    {
        $id = $this->request->getPost('id');
        $nom = $this->request->getPost('nom');
        $prenom = $this->request->getPost('prenom');
        $email = $this->request->getPost('email');
        $username = $this->request->getPost('username');
        $mdp = $this->request->getPost('mdp');
        $profile = $this->request->getPost('profile');
        if ($id) {
            $userMod = new UserModel();
            $data = $userMod->find($id);
            if ($data) {
                $donnee = [
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'email' => $email,
                    'username' => $username,
                    'motdepasse' => $mdp,
                    'profile_id' => $profile
                ];
                $userMod->update($id, $donnee);
            }
        }
        return redirect()->to(site_url('gestionUtilisateur'));
    }

    public function DeleteUser($id = null)
    {
        if ($id != null) {
            $userMod = new UserModel();
            $userMod->delete($id);
        }
        return redirect()->to(site_url('gestionUtilisateur'));
    }

    public function ChangeStatut($id = null)
    {
        if ($id != null) {
            $userMod = new UserModel();
            $user = $userMod->find($id);
            if ($user) {
                $newStatut = ($user['statut'] == 1) ? 0 : 1;
                $userMod->update($id, ['statut' => $newStatut]);
            }
        }
        return redirect()->to(site_url('gestionUtilisateur'));
    }

    public function login()
    {
        $userMod = new UserModel();
        $roleMod = new RoleModel();
        $username = $this->request->getPost('username');
        $mdp = $this->request->getPost('mdp');
        $user = $userMod->getUserByEmail($username);

        if ($user && $mdp === $user['motdepasse']) {
            if ($user['statut'] == 1) {
                $role = $roleMod->getRole($user['profile_id']);
                session()->set([
                    'prenom' => $user['prenom'],
                    'profile_id' => $user['profile_id'],
                    'role' => $role,
                    'profil' => $user['profils'],
                    'isLogged' => true
                ]);

                $tab_smenu = array();
                foreach ($role as $r) {
                    $tab_smenu[$r['id_sousmenu']] = [
                        'add' => $r['d_add'],
                        'read' => $r['d_read'],
                        'del' => $r['d_del'],
                        'upd' => $r['d_upd']
                    ];
                }
                session()->set('tab_smenu', $tab_smenu);

                return redirect()->to(site_url('index'));
            } else {
                return redirect()->back()->with('errorMessage', 'Cet utilisateur est bloqué, contactez votre administrateur');
            }
        } else {
            return redirect()->back()->with('errorMessage', 'Username ou Mot de passe incorrect');
        }
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('login'));
    }

    public function SendEmail($id = null)
    {
        if ($id != null) {
            $userMod = new UserModel();
            $user = $userMod->find($id);

            if ($user) {
                $to = $user['email'];
                $subject = "Vos informations de connexion";
                $message = "
                Bonjour {$user['prenom']} {$user['nom']},<br><br>
                Voici vos informations de connexion à la plateforme :<br>
                <b>Nom d'utilisateur :</b> {$user['username']}<br>
                <b>Mot de passe :</b> {$user['motdepasse']}<br><br>
                Merci de vous connecter sur la plateforme.<br>
                <i>Ce message est automatique, ne pas répondre.</i>
            ";

                $emailConfig = [
                    'protocol' => 'smtp',
                    'SMTPHost' => 'pro.turbo-smtp.com',
                    'SMTPUser' => 'diery.seye@education.sn',
                    'SMTPPass' => 'Pexice@10#',
                    'SMTPPort' => 465,
                    'SMTPCrypto' => 'ssl',
                    'mailType' => 'html',
                    'charset' => 'utf-8',
                    'newline' => "\r\n",
                    'wordWrap' => true,
                ];

                $email = \Config\Services::email($emailConfig);
                $email->setFrom('no-reply@education.sn', 'Mamzo - Ne pas répondre');
                $email->setTo($to);
                $email->setSubject($subject);
                $email->setMessage($message);

                if ($email->send()) {
                    return redirect()->back()->with('successMessage', 'Email envoyé à l\'utilisateur.');
                } else {
                    $data = $email->printDebugger(['headers']);
                    dd($data);
                }
            }
        }
        return redirect()->back()->with('errorMessage', 'ID utilisateur invalide.');
    }

}