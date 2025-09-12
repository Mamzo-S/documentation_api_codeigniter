<?php

namespace App\Controllers;

use App\Models\ArchitectureModel;
use App\Models\FormatModel;
use CodeIgniter\HTTP\ResponseInterface;
use OpenApi\Annotations as OA;

class ArchitectureController extends BaseController
{
    public function AfficherArchitecture()
    {
        $archi = new ArchitectureModel();
        $format = new FormatModel();
        $donnee['format'] = $format->findAll();
        $donnee['archi'] = $archi->AfficherArchitecture();
        return view('architecture', $donnee);
    }

    public function AjoutArchitecture()
    {
        $archi_name = $this->request->getPost('archi');
        $format = $this->request->getPost('format');
        $header = $this->request->getPost('hed');

        $archi = new ArchitectureModel();
        $donnee = [
            'architecture_name' => $archi_name,
            'format_donnee' => $format,
            'header' => $header,
        ];
        $archi->insert($donnee);
        return redirect()->to(site_url('architecture'));

    }

    public function DeleteArchitecture($id = null)
    {
        if ($id != null) {
            $archi = new ArchitectureModel();
            $archi->delete($id);
        }
        return redirect()->to(site_url('architecture'));
    }

    public function EditArchitecture()
    {
        $id = $this->request->getPost('id');
        $archi_name = $this->request->getPost('archi');
        $format = $this->request->getPost('format');
        $header = $this->request->getPost('hed');

        if ($id) {
            $archi = new ArchitectureModel();
            $data = $archi->find($id);

            if ($data) {
                $donnee = [
                    'architecture_name' => $archi_name,
                    'format_donnee' => $format,
                    'header' => $header,
                ];
                $archi->update($id, $donnee);
            }
        }
        return redirect()->to(site_url('architecture'));
    }

    // gestion architecture pour format json

    /**
     * @OA\Get(
     *     path="/architectures",
     *     tags={"Architecture"},
     *     summary="Afficher toutes les architectures",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des architectures"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     */
    public function AfficherArchitectureJson()
    {
        $archi = new ArchitectureModel();
        $donnee = $archi->AfficherArchitecture();
        return $this->response->setJSON($donnee);
    }

    /**
     * @OA\Get(
     *     path="/architectures/{id}",
     *     tags={"Architecture"},
     *     summary="Afficher une architecture par son id",
     * @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'architecture",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Architecture trouvee"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     */
    public function AfficherArchitectureById($id)
    {
        $archi = new ArchitectureModel();
        $donnee['archi'] = $archi->where('id', $id)->first();
        return $this->response->setJSON($donnee);
    }

    /**
     * @OA\Post(
     *     path="/architectures",
     *     tags={"Architecture"},
     *     summary="Ajouter une architecture",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="architecture_name", type="string", example="Nouvelle architecture"),
     *             @OA\Property(property="format_donnee", type="string", example="JSON"),
     *             @OA\Property(property="header", type="string", example="Authorization: Bearer ...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Architecture ajoutée"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requête invalide"
     *     )
     * )
     */

    public function AjoutArchitectureJson()
    {
        $data = $this->request->getJSON(true);
        $archi = new ArchitectureModel();
        $archi->insert([
            'architecture_name' => $data['architecture_name'] ?? null,
            'format_donnee' => $data['format_donnee'] ?? null,
            'header' => $data['header'] ?? null,
        ]);

        return $this->response
            ->setStatusCode(201)
            ->setJSON(['message' => 'Architecture ajoutée avec succès']);
    }

    /**
     * @OA\Put(
     *     path="/architectures/{id}",
     *     tags={"Architecture"},
     *     summary="Modifier une architecture existante",
     *     description="Met à jour les informations d'une architecture par son ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'architecture à modifier",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"architecture_name"},
     *             @OA\Property(property="architecture_name", type="string", example="Architecture modifiée"),
     *             @OA\Property(property="format_donnee", type="string", example="JSON"),
     *             @OA\Property(property="header", type="string", example="Authorization: Bearer ...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Architecture modifiée avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Architecture non trouvée"
     *     )
     * )
     */
    public function EditArchitectureJson($id)
    {
        $archi = new ArchitectureModel();

        $data = $archi->find($id);
        if (!$data) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['message' => 'Architecture non trouvée']);
        }

        $json = $this->request->getJSON(true);
        $donnee = [
            'architecture_name' => $json['architecture_name'] ?? $data['architecture_name'],
            'format_donnee' => $json['format_donnee'] ?? $data['format_donnee'],
            'header' => $json['header'] ?? $data['header'],
        ];

        $archi->update($id, $donnee);

        return $this->response
            ->setStatusCode(200)
            ->setJSON(['message' => 'Architecture modifiée avec succès']);
    }

    /**
     * @OA\Delete(
     *     path="/architectures/{id}",
     *     tags={"Architecture"},
     *     summary="Supprimer une architecture par son id",
     *     description="Supprime une architecture existante",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'architecture à supprimer",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Architecture supprimée avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Architecture non trouvée"
     *     )
     * )
     */
    public function DeleteArchitectureJson($id = null)
    {
        $archi = new ArchitectureModel();

        if ($id === null) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['message' => 'ID manquant']);
        }

        $exist = $archi->find($id);
        if (!$exist) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['message' => 'Architecture non trouvée']);
        }

        $archi->delete($id);

        return $this->response
            ->setStatusCode(200)
            ->setJSON(['message' => 'Architecture supprimée avec succès']);
    }

}
