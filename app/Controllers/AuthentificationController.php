<?php

namespace App\Controllers;

use App\Models\AuthentificationModel;
use App\Models\LienModel;
use App\Models\MethodeModel;

class AuthentificationController extends BaseController
{

    public function AfficherAuthentification()
    {
        $auth = new AuthentificationModel();
        $lien = new LienModel();
        $methode = new MethodeModel();
        $donnee['methode'] = $methode->find();
        $donnee['lien'] = $lien->findAll();
        $donnee['auth'] = $auth->AfficherAuthentification();
        return view('authentification', $donnee);
    }

    public function AjoutAuthentification()
    {
        $methode = $this->request->getPost('meth');
        $lien = $this->request->getPost('lien');
        $body = $this->request->getPost('body');
        $auth = new AuthentificationModel();
        $donnee = [
            'methode_auth' => $methode,
            'lien_auth' => $lien,
            'body' => $body
        ];
        $auth->insert($donnee);
        return redirect()->to(site_url('authentification'));
    }

    public function DeleteAuthentification($id = null)
    {
        if ($id != null) {
            $auth = new AuthentificationModel();
            $auth->delete($id);
        }
        return redirect()->to(site_url('authentification'));
    }

    public function EditAuthentification()
    {
        $id = $this->request->getPost('id');
        $methode = $this->request->getPost('meth');
        $lien = $this->request->getPost('lien');
        $body = $this->request->getPost('body');

        if ($id) {
            $auth = new AuthentificationModel();
            $data = $auth->find($id);

            if ($data) {
                $donnee = [
                    'methode_auth' => $methode,
                    'lien_auth' => $lien,
                    'body' => $body
                ];
                $auth->update($id, $donnee);
            }
        }

        return redirect()->to(site_url('authentification'));
    }


    //gestion authentification pour format json
    /**
     * @OA\Get(
     *     path="/authentifications",
     *     tags={"Authentification"},
     *     summary="Afficher toutes les authentifications",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des authentifications"
     *     )
     * )
     */
    public function AfficherAuthentificationJson()
    {
        $auth = new AuthentificationModel();
        $donnee = $auth->AfficherAuthentification();
        return $this->response->setJSON($donnee);
    }

    /**
     * @OA\Get(
     *     path="/authentifications/{id}",
     *     tags={"Authentification"},
     *     summary="Afficher une authentification par son id",
     * @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'authentification",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Authentification trouvée"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     */
    public function AfficherAuthentificationById($id)
    {
        $auth = new AuthentificationModel();
        $donnee = $auth->where('id', $id)->first();
        return $this->response->setJSON($donnee);
    }

    /**
     * @OA\Post(
     *     path="/authentifications",
     *     tags={"Authentification"},
     *     summary="Ajouter une authentification",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="methode_auth", type="string", example="id_methode"),
     *             @OA\Property(property="lien_auth", type="string", example="id_lien"),
     *             @OA\Property(property="body", type="string", example="{'username': 'coucou', 'password': 'passer'}")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Authentification ajoutée"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requête invalide"
     *     )
     * )
     */

    public function AjoutAuthentificationJson()
    {
        $data = $this->request->getJSON(true);
        $auth = new AuthentificationModel();
        $auth->insert([
            'methode_auth' => $data['methode_auth'],
            'lien_auth' => $data['lien_auth'],
            'body' => $data['body'],
        ]);

        return $this->response
            ->setStatusCode(201)
            ->setJSON(['message' => 'Authentification ajoutée avec succès']);
    }

    /**
     * @OA\Put(
     *     path="/authentifications/{id}",
     *     tags={"Authentification"},
     *     summary="Modifier une authentification existante",
     *     description="Met à jour les informations d'une authentification par son ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'authentification à modifier",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"architecture_name"},
     *             @OA\Property(property="methode_auth", type="string", example="id_methode"),
     *             @OA\Property(property="lien_auth", type="string", example="id_lien"),
     *             @OA\Property(property="body", type="string", example="{'username': 'coucou', 'password': 'passer'}")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Authentification modifiée avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Authentification non trouvée"
     *     )
     * )
     */

    public function EditAuthentificationJson($id)
    {
        $auth = new AuthentificationModel();
        $data = $auth->find($id);
        if (!$data) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['message' => 'Authentification non trouvée']);
        }

        $json = $this->request->getJSON(true);
        $donnee = [
            'methode_auth' => $json['methode_auth'] ?? $data['methode_auth'],
            'lien_auth' => $json['lien_auth'] ?? $data['lien_auth'],
            'body' => $json['body'] ?? $data['body'],
        ];

        $auth->update($id, $donnee);

        return $this->response
            ->setStatusCode(200)
            ->setJSON(['message' => 'Authentification modifiée avec succès']);

    }

    /**
     * @OA\Delete(
     *     path="/authentifications/{id}",
     *     tags={"Authentification"},
     *     summary="Supprimer une authentification par son id",
     *     description="Supprime une authentification existante",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'authentification à supprimer",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Authentification supprimée avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Authentification non trouvée"
     *     )
     * )
     */
    public function DeleteAuthentificationJson($id)
    {
        $auth = new AuthentificationModel();

        $exist = $auth->find($id);
        if (!$exist) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['message' => 'Authentification non trouvée']);
        }

        $auth->delete($id);

        return $this->response
            ->setStatusCode(200)
            ->setJSON(['message' => 'Authentification supprimée avec succès']);
    }

}
