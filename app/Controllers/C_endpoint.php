<?php

namespace App\Controllers;

use App\Models\M_endpoint;
use App\Models\M_lien;
use App\Models\M_methode;
use OpenApi\Annotation as OA;

class C_endpoint extends BaseController
{
    public function AfficherEndpoints()
    {
        $endpoint = new M_endpoint();
        $lien = new M_lien();
        $methode = new M_methode();
        $donnee['methode'] = $methode->findAll();
        $donnee['endpoint'] = $endpoint->AfficherEndpoints();
        // var_dump($donnee['endpoint']);
        // exit;
        $donnee['lien'] = $lien->findAll();
        return view('V_endpoints', $donnee);
    }

    public function AjoutEndpoint()
    {
        $titre = $this->request->getPost('titre');
        $lien = $this->request->getPost('lien');
        $param = $this->request->getPost('param');
        $methode = $this->request->getPost('meth');
        $type = $this->request->getPost('type');
        $end = $this->request->getPost('end');
        $repS = $this->request->getPost('rep-success');
        $repE = $this->request->getPost('rep-error');
        $desc = $this->request->getPost('desc');

        $endModel = new M_endpoint();
        $donnee = [
            'titre' => $titre,
            'lien_end' => $lien,
            'parametre' => $param,
            'methode_end' => $methode,
            'type' => $type,
            'endName' => $end,
            'reponse_success' => $repS,
            'reponse_error' => $repE,
            'description' => $desc
        ];
        $endModel->insert($donnee);
        return redirect()->to(site_url('endpoints'));
    }

    public function DeleteEndpoint($id = null)
    {
        if ($id != null) {
            $end = new M_endpoint();
            $end->delete($id);
        }
        return redirect()->to(site_url('endpoints'));
    }

    public function EditEndpoint()
    {
        $id = $this->request->getPost('id');
        $titre = $this->request->getPost('titre');
        $lien = $this->request->getPost('lien');
        $param = $this->request->getPost('param');
        $methode = $this->request->getPost('meth');
        $type = $this->request->getPost('type');
        $end = $this->request->getPost('end');
        $repS = $this->request->getPost('rep-success');
        $repE = $this->request->getPost('rep-error');
        $desc = $this->request->getPost('desc');

        if ($id) {
            $endModel = new M_endpoint();
            $data = $endModel->find($id);

            if ($data) {
                $donnee = [
                    'titre' => $titre,
                    'lien_end' => $lien,
                    'parametre' => $param,
                    'methode_end' => $methode,
                    'type' => $type,
                    'endName' => $end,
                    'reponse_success' => $repS,
                    'reponse_error' => $repE,
                    'description' => $desc
                ];
                $endModel->update($id, $donnee);
            }
        }
        return redirect()->to(site_url('endpoints'));
    }

    //============Gestion Endpoint pour format json=============

    //================== API JSON ==================
    //===GET /endpoint
    /**
     * @OA\Get(
     *     path="/endpoint",
     *     tags={"Endpoint"},
     *     summary="Afficher tous les endpoints",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des endpoints"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Aucun endpoint trouvé"
     *     )
     * )
     */
    public function AfficherEndpointJson()
    {
        $endpoint = new M_endpoint();
        $donnee = $endpoint->findAll();

        if (empty($donnee)) {
            return $this->response
                ->setJSON(['message' => 'Aucun endpoint trouvé'])
                ->setStatusCode(404);
        }

        return $this->response
            ->setJSON($donnee)
            ->setStatusCode(200);
    }

    /**
     * @OA\Get(
     *     path="/endpoint/{id}",
     *     tags={"Endpoint"},
     *     summary="Afficher un endpoint par ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'endpoint",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *          response=200, 
     *          description="Endpoint trouvé"),
     *     @OA\Response(response=404, description="Endpoint non trouvé")
     * )
     */
    public function AfficherEndpointByIdJson($id = null)
    {
        $endpoint = new M_endpoint();
        $donnee = $endpoint->find($id);

        if (!$donnee) {
            return $this->response
                ->setJSON(['message' => "Endpoint avec ID $id non trouvé"])
                ->setStatusCode(404);
        }

        return $this->response
            ->setJSON($donnee)
            ->setStatusCode(200);
    }

    /**
     * @OA\Post(
     *     path="/endpoint",
     *     tags={"Endpoint"},
     *     summary="Créer un nouvel endpoint",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="lien_end", type="string"),
     *             @OA\Property(property="parametre", type="string"),
     *             @OA\Property(property="methode_end", type="string"),
     *             @OA\Property(property="reponse", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Endpoint créé"),
     *     @OA\Response(response=400, description="Données invalides")
     * )
     */
    public function AjoutEndpointJson()
    {
        $donnee = $this->request->getJSON(true);
        $endpoint = new M_endpoint();
        $endpoint->insert([
            'lien_end' => $donnee['lien_end'] ?? null,
            'parametre' => $donnee['parametre'] ?? null,
            'methode_end' => $donnee['methode_end'] ?? null,
            'reponse' => $donnee['reponse'] ?? null
        ]);
        return $this->response
            ->setStatusCode(201)
            ->setJSON(['message' => 'Endpoint crée avec succés']);
    }

    /**
     * @OA\Put(
     *     path="/endpoint/{id}",
     *     tags={"Endpoint"},
     *     summary="Modifier un endpoint",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'endpoint",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="lien_end", type="string"),
     *             @OA\Property(property="parametre", type="string"),
     *             @OA\Property(property="methode_end", type="string"),
     *             @OA\Property(property="reponse", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Endpoint modifié"),
     *     @OA\Response(response=404, description="Endpoint non trouvé")
     * )
     */
    public function EditEndpointJson($id = null)
    {
        $endpoint = new M_endpoint();
        $donnee = $this->request->getJSON(true);

        $exist = $endpoint->find($id);
        if (!$exist) {
            return $this->response
                ->setJSON(['message' => "Endpoint avec ID $id non trouvé"])
                ->setStatusCode(404);
        }

        $endpoint->update($id, $donnee);
        return $this->response
            ->setJSON(['message' => 'Endpoint modifié'])
            ->setStatusCode(200);
    }

    /**
     * @OA\Delete(
     *     path="/endpoint/{id}",
     *     tags={"Endpoint"},
     *     summary="Supprimer un endpoint",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'endpoint",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Endpoint supprimé"),
     *     @OA\Response(response=404, description="Endpoint non trouvé")
     * )
     */
    public function DeleteEndpointJson($id = null)
    {
        $endpoint = new M_endpoint();
        $exist = $endpoint->find($id);

        if (!$exist) {
            return $this->response
                ->setJSON(['message' => "Endpoint avec ID $id non trouvé"])
                ->setStatusCode(404);
        }

        $endpoint->delete($id);
        return $this->response
            ->setJSON(['message' => 'Endpoint supprimé'])
            ->setStatusCode(200);
    }
}