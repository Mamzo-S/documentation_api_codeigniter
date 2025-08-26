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
                // $tab_menu = array();
                // $cur_m = '';
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
                // Prépare le message
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

                // Configuration email
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

    // public function sendmail($prenom,$nom,$mail,$mdp,$ien)
    // {
    //     if (ENVIRONMENT !== 'production')
    //     {
    //         $conf = Array(
    //             'protocol'  => 'smtp',
    //             'smtp_host' => 'ssl://smtp.googlemail.com',
    //             'smtp_port' =>	465,
    //             'smtp_user' => 'info@education.sn',
    //             'smtp_pass' => 'SimenSupport',
    //             'mailtype'  => 'html',
    //             'charset'   => 'utf-8');
    //     }
    //     else {
    //         $conf = Array(
    //             'protocol' => 'smtp',
    //             'smtp_host' => 'us2.smtp.mailhostbox.com',
    //             'smtp_port' => 587,
    //             'smtp_user' => 'noreply3@education.sn',
    //             'smtp_pass' => '!HO^$D@5',
    //             'mailtype' => 'html',
    //             'charset' => 'utf-8'
    //         );
    //     }
    //     $email = send_mail_affectation1($prenom,$nom,$mail,$mdp);
    //     $this->load->library('email',$conf);
    //     $this->email->from('noreply3@education.sn', 'Service technique SIMEN');
    //     $this->email->to($mail);
    //     $this->email->bcc('ndaoabdoulaye82@gmail.com');
    //     $this->email->subject('Service SIMEN  - MEN-SYSGAR');
    //     $this->email->message($email);
    //     $this->email->set_newline("\r\n");
    //     return $this->email->send();
    // }
}