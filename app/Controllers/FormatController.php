<?php

namespace App\Controllers;

use App\Models\FormatModel;

class FormatController extends BaseController
{
    public function AfficherFormat()
    {
        $format = new FormatModel();
        $donnee['format'] = $format->findAll();
        return view('format_donnee', $donnee);
    }

    public function AjoutFormat()
    {
        $Formats = new FormatModel();
        $format = $this->request->getPost('format');
        $donnee = ['format' => $format];
        $Formats->insert($donnee);
        return redirect()->to(site_url('format_donnee'));
    }

    public function EditFormat()
    {
        $id = $this->request->getPost('id');
        $format = $this->request->getPost('format');
        if ($id) {
            $Formats = new FormatModel();
            $data = $Formats->find($id);
            if ($data) {
                $donnee = ['format' => $format];
                $Formats->update($id, $donnee);
            }
        }
        return redirect()->to(site_url('format_donnee'));
    }

    public function DeleteFormat($id = null)
    {
        if ($id != null) {
            $format = new FormatModel();
            $format->delete($id);
        }
        return redirect()->to(site_url('format_donnee'));
    }

    //gestion des formats pour format json

    /**
     * @OA\Get(
     *     path="/format",
     *     tags={"Format de donnee"},
     *     summary="Afficher tous les formats de donnees",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des formats de donnees"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     */
    public function AfficherFormatJson()
    {
        $format = new FormatModel();
        $donnee = $format->findAll();
        return $this->response->setJSON($donnee);
    }

    /**
     * @OA\Get(
     *     path="/format/{id}",
     *     tags={"Format de donnee"},
     *     summary="Afficher un format de donnee par son id",
     * @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID du format",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Format de donnee trouvé",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     */
    public function AfficherFormatById($id)
    {
        $format = new FormatModel();
        $donnee = $format->where('id', $id)->first();
        if (!$donnee) {
            return $this->response
                ->setJSON(['message' => "Format avec ID $id non trouvé"])
                ->setStatusCode(404);
        }

        return $this->response
            ->setJSON($donnee)
            ->setStatusCode(200);
    }

    /**
     * @OA\Post(
     *     path="/format",
     *     tags={"Format de donnee"},
     *     summary="Ajouter un format de donnee",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="format", type="string", example="nom format"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Format ajouté"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requête invalide"
     *     )
     * )
     */

    public function AjoutFormatJson()
    {
        $format = new FormatModel();
        $donnee = $this->request->getJSON(true);
        $format->insert([
            'format' => $donnee['format'],
        ]);
        return $this->response
            ->setStatusCode(201)
            ->setJSON(['message' => 'Format crée avec succés']);
    }

    /**
     * @OA\Put(
     *     path="/format/{id}",
     *     tags={"Format de donnee"},
     *     summary="Modifier un format de donnee existant par son id",
     *     description="Met à jour les informations d'un format de donnee par son ID",
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="Id du format à modifier",
     *     @OA\Schema(type="integer")
     * ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="format", type="string", example="nouveau format"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Format modifié"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requête invalide"
     *     )
     * )
     */

    public function EditFormatJson($id)
    {
        $format = new FormatModel();
        $donnee = $this->request->getJSON(true);
        $data = $format->find($id);
        if (!$data) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['message' => 'Format de donnee non trouvée']);
        }
        $format->update($id, $donnee);
        return $this->response
            ->setJSON(['message' => 'Format de donnee modifié'])
            ->setStatusCode(200);
    }

    /**
     * @OA\Delete(
     *     path="/format/{id}",
     *     tags={"Format de donnee"},
     *     summary="Supprimer un format de donnee par son ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID du format",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Format supprimé"),
     *     @OA\Response(response=404, description="Format non trouvé")
     * )
     */
    public function DeleteFormatJson($id) {
        $format = new FormatModel();
        $exist = $format->find($id);

        if (!$exist) {
            return $this->response
                ->setJSON(['message' => "Format avec ID $id non trouvé"])
                ->setStatusCode(404);
        }
        $format->delete($id);
        return $this->response
            ->setJSON(['message' => 'Format supprimé'])
            ->setStatusCode(200);
    }
}
