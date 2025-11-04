<?php

namespace App\Controllers;

use App\Models\M_lien;

class C_lien extends BaseController
{
    public function AfficherLien()
    {
        $lien = new M_lien();
        $donnee['lien'] = $lien->findAll();
        return view('V_base_url', $donnee);
    }

    public function AjoutLien()
    {
        $lien = new M_lien();
        $base_url = $this->request->getPost('lien');
        $nom_url = $this->request->getPost('nom_lien');
        $donnee = ['base_url' => $base_url, 'nom_url'=> $nom_url];
        $lien->insert($donnee);
        return redirect()->to(site_url('base_url'));
    }

    public function EditLien()
    {
        $id = $this->request->getPost('id');
        $base_url = $this->request->getPost('lien');
        $nom_url = $this->request->getPost('nom_lien');
        if ($id) {
            $lien = new M_lien();
            $data = $lien->find($id);
            if ($data) {
                $donnee = ['base_url' => $base_url, 'nom_url' => $nom_url];
                $lien->update($id, $donnee);
            }
        }
        return redirect()->to(site_url('base_url'));
    }

    public function DeleteLien($id = null)
    {
        if ($id != null) {
            $lien = new M_lien();
            $lien->delete($id);
        }
        return redirect()->to(site_url('base_url'));
    }

    //gestion des bases url pour format json

    /**
     * @OA\Get(
     *     path="/lien",
     *     tags={"Base url"},
     *     summary="Afficher tous les liens",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des bases url"
     *     )
     * )
     */
    public function AfficherLienJson()
    {
        $lien = new M_lien();
        $donnee = $lien->findAll();
        return $this->response->setJSON($donnee);
    }

    /**
     * @OA\Get(
     *     path="/lien/{id}",
     *     tags={"Base url"},
     *     summary="Afficher un lien par son id",
     * @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID du lien",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lien trouvé"
     *     )
     * )
     */
    public function AfficherLienById($id)
    {
        $lien = new M_lien();
        $donnee = $lien->where('id', $id)->first();
        return $this->response->setJSON($donnee);
    }

    /**
     * @OA\Post(
     *     path="/lien",
     *     tags={"Base url"},
     *     summary="Ajouter une base url",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="base_url", type="string", example="http://test2.com"),
     *             @OA\Property(property="nom_url", type="string", example="name4"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Lien ajouté"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requête invalide"
     *     )
     * )
     */

    public function AjoutLienJson()
    {
        $lien = new M_lien();
        $data = $this->request->getJSON(true);
        $lien->insert([
            'base_url' => $data['base_url'],
            'nom_url' => $data['nom_url'],
        ]);
        return $this->response
            ->setStatusCode(201)
            ->setJSON(['message' => 'Lien ajouté avec succès']);
    }

    /**
     * @OA\Put(
     *     path="/lien/{id}",
     *     tags={"Base url"},
     *     summary="Modifier une base url existante",
     *     description="Met à jour les informations d'une base url par son ID",
     * @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la base url à modifier",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="base_url", type="string", example="nouveau lien"),
     *             @OA\Property(property="nom_url", type="string", example="nouveau nom"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lien modifié"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requête invalide"
     *     )
     * )
     */
    public function EditLienJson($id)
    {
        $lien = new M_lien();
        $data = $lien->find($id);
        if (!$data) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['message' => 'Base url non trouvée']);
        }
        $json = $this->request->getJSON(true);
        $donnee = [
            'base_url' => $json['base_url'] ?? $data['base_url'],
            'nom_url' => $json['nom_url'] ?? $data['nom_url'],
        ];

        $lien->update($id, $donnee);

        return $this->response
            ->setStatusCode(200)
            ->setJSON(['message' => 'Base url modifiée avec succès']);

    }

     /**
     * @OA\Delete(
     *     path="/lien/{id}",
     *     tags={"Base url"},
     *     summary="Supprimer une base ur, par son id",
     *     description="Supprime une base url existante",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la base url à supprimer",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Base url supprimée avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Base url non trouvée"
     *     )
     * )
     */
    public function DeleteLienJson($id)
    {
        $lien = new M_lien();

        $exist = $lien->find($id);
        if (!$exist) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['message' => 'Base url non trouvée']);
        }

        $lien->delete($id);

        return $this->response
            ->setStatusCode(200)
            ->setJSON(['message' => 'Base url supprimée avec succès']);
    }
}