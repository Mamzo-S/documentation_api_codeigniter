<?php

namespace App\Controllers;

use App\Models\M_methode;

class C_methode extends BaseController
{
    public function AfficherMethode()
    {
        $lien = new M_methode();
        $donnee['methode'] = $lien->findAll();
        return view('V_methode', $donnee);
    }

    public function AjoutMethode()
    {
        $methode = new M_methode();
        $meth = $this->request->getPost('meth');
        $donnee = ['methode_name' => $meth];
        $methode->insert($donnee);
        return redirect()->to(site_url('methode'));
    }

    public function EditMethode()
    {
        $id = $this->request->getPost('id');
        $meth = $this->request->getPost('meth');
        if ($id) {
            $methode = new M_methode();
            $data = $methode->find($id);
            if ($data) {
                $donnee = ['methode_name' => $meth];
                $methode->update($id, $donnee);
            }
        }
        return redirect()->to(site_url('methode'));
    }

    public function DeleteMethode($id = null)
    {
        if ($id != null) {
            $methode = new M_methode();
            $methode->delete($id);
        }
        return redirect()->to(site_url('methode'));
    }

    //gestion des formats pour format json

    /**
     * @OA\Get(
     *     path="/methodes",
     *     tags={"Methode"},
     *     summary="Afficher toutes les methodes",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des methodes"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     */
    public function AfficherMethodeJson()
    {
        $methode = new M_methode();
        $donnee = $methode->findAll();
        return $this->response->setJSON($donnee);
    }

    /**
     * @OA\Get(
     *     path="/methodes/{id}",
     *     tags={"Methode"},
     *     summary="Afficher une methode par son id",
     * @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la methode",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Methode trouvée",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     */
    public function AfficherMethodeById($id)
    {
        $methode = new M_methode();
        $donnee = $methode->where('id', $id)->first();
        if (!$donnee) {
            return $this->response
                ->setJSON(['message' => "Methode avec ID $id non trouvée"])
                ->setStatusCode(404);
        }

        return $this->response
            ->setJSON($donnee)
            ->setStatusCode(200);
    }

    /**
     * @OA\Post(
     *     path="/methodes",
     *     tags={"Methode"},
     *     summary="Ajouter une methode",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="methode_name", type="string", example="nom methode"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Methode ajoutée"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requête invalide"
     *     )
     * )
     */

    public function AjoutMethodeJson()
    {
        $methode = new M_methode();
        $donnee = $this->request->getJSON(true);
        $methode->insert([
            'methode_name' => $donnee['methode_name'],
        ]);
        return $this->response
            ->setStatusCode(201)
            ->setJSON(['message' => 'Methode crée avec succés']);
    }

    /**
     * @OA\Put(
     *     path="/methodes/{id}",
     *     tags={"Methode"},
     *     summary="Modifier une methode existante par son id",
     *     description="Met à jour les informations d'une methode par son ID",
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="Id de la methode à modifier",
     *     @OA\Schema(type="integer")
     * ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="methode_name", type="string", example="nouveau methode"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Methode modifiée"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requête invalide"
     *     )
     * )
     */

    public function EditMethodeJson($id)
    {
        $methode = new M_methode();
        $donnee = $this->request->getJSON(true);
        $data = $methode->find($id);
        if (!$data) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['message' => 'Methode non trouvée']);
        }
        $methode->update($id, $donnee);
        return $this->response
            ->setJSON(['message' => 'Methode modifiée'])
            ->setStatusCode(200);
    }

    /**
     * @OA\Delete(
     *     path="/methodes/{id}",
     *     tags={"Methode"},
     *     summary="Supprimer une methode par son ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la methode",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Methode supprimée"),
     *     @OA\Response(response=404, description="Methode non trouvée")
     * )
     */
    public function DeleteMethodeJson($id) {
        $methode = new M_methode();
        $exist = $methode->find($id);

        if (!$exist) {
            return $this->response
                ->setJSON(['message' => "Methode avec ID $id non trouvée"])
                ->setStatusCode(404);
        }
        $methode->delete($id);
        return $this->response
            ->setJSON(['message' => 'Methode supprimée'])
            ->setStatusCode(200);
    }
}