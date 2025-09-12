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
        $user = $userMod->getUserByUsername($username, $mdp);

        if ($user) {
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




       //gestion des users pour format json

    /**
     * @OA\Get(
     *     path="/user",
     *     tags={"Utilisateurs"},
     *     summary="Afficher tous les utilisateurs",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des utilisateurs"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     */
    public function AfficherUserJson()
    {
        $user = new UserModel();
        $donnee = $user->findAll();
        return $this->response->setJSON($donnee);
    }

    /**
     * @OA\Get(
     *     path="/user/{id}",
     *     tags={"Utilisateurs"},
     *     summary="Afficher un utilisateur par son id",
     * @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'utilisateur",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Utilisateur trouvé",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     */
    public function AfficherUserById($id)
    {
        $user = new UserModel();
        $donnee = $user->where('id', $id)->first();
        if (!$donnee) {
            return $this->response
                ->setJSON(['message' => "Utilisateur avec l'ID $id non trouvé"])
                ->setStatusCode(404);
        }

        return $this->response
            ->setJSON($donnee)
            ->setStatusCode(200);
    }

    /**
     * @OA\Post(
     *     path="/user",
     *     tags={"Utilisateurs"},
     *     summary="Ajouter un utilisateur",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nom", type="string", example="nom"),
     *             @OA\Property(property="prenom", type="string", example="prenom"),
     *             @OA\Property(property="email", type="string", example="email"),
     *             @OA\Property(property="motdepasse", type="string", example="passer"),
     *             @OA\Property(property="username", type="string", example="user"),
     *             @OA\Property(property="profile_id", type="string", example="id de profil"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Utilisateur ajouté"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requête invalide"
     *     )
     * )
     */

    public function AjoutUserJson()
    {
        $user = new UserModel();
        $donnee = $this->request->getJSON(true);
        $user->insert([
            'nom' => $donnee['nom'],
            'prenom' => $donnee['prenom'],
            'email' => $donnee['email'],
            'motdepasse' => $donnee['motdepasse'],
            'username' => $donnee['username'],
            'profile_id' => $donnee['profile_id'],
            'statut' => 1,
        ]);
        return $this->response
            ->setStatusCode(201)
            ->setJSON(['message' => 'Utilisateur créé avec succés']);
    }

    /**
     * @OA\Put(
     *     path="/user/{id}",
     *     tags={"Utilisateurs"},
     *     summary="Modifier un utilisateur existant par son id",
     *     description="Met à jour les informations d'un utilisateur par son ID",
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="Id de l'utilisateur' à modifier",
     *     @OA\Schema(type="integer")
     * ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nom", type="string", example="nom"),
     *             @OA\Property(property="prenom", type="string", example="prenom"),
     *             @OA\Property(property="email", type="string", example="email"),
     *             @OA\Property(property="motdepasse", type="string", example="passer"),
     *             @OA\Property(property="username", type="string", example="user"),
     *             @OA\Property(property="profile_id", type="string", example="id de profil"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Utilisateur modifié"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requête invalide"
     *     )
     * )
     */

    public function EditUserJson($id)
    {
        $user = new UserModel();
        $donnee = $this->request->getJSON(true);
        $data = $user->find($id);
        if (!$data) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['message' => 'Utilisateur non trouvé']);
        }
        $user->update($id, $donnee);
        return $this->response
            ->setJSON(['message' => 'Utilisateur modifié'])
            ->setStatusCode(200);
    }

    /**
     * @OA\Delete(
     *     path="/user/{id}",
     *     tags={"Utilisateurs"},
     *     summary="Supprimer un utilisateur par son ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'utilisateur'",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Utilisateur supprimé"),
     *     @OA\Response(response=404, description="Utilisateur non trouvé")
     * )
     */
    public function DeleteUserJson($id) {
        $user = new UserModel();
        $exist = $user->find($id);

        if (!$exist) {
            return $this->response
                ->setJSON(['message' => "Utilisateur avec ID $id non trouvé"])
                ->setStatusCode(404);
        }
        $user->delete($id);
        return $this->response
            ->setJSON(['message' => 'Utilisateur supprimé'])
            ->setStatusCode(200);
    }

}