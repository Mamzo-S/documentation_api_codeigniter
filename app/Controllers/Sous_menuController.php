<?php

namespace App\Controllers;

use App\Models\Sous_menuModel;
use App\Models\MenuModel;

class Sous_menuController extends BaseController
{
    public function AfficherSous_menu()
    {
        $menu_M = new MenuModel();
        $sous_M = new Sous_menuModel();
        $donnee['menu'] = $menu_M->findAll();
        $donnee['sous_menu'] = $sous_M->AfficherSous_menu();
        return view('sous_menu', $donnee);
    }

    public function AjoutSous_menu()
    {
        $sous_M = new Sous_menuModel();
        $code = $this->request->getPost('code');
        $lib = $this->request->getPost('libelle');
        $menu = $this->request->getPost('menu');
        $etat = 1;
        $donnee = [
            'code' => $code,
            'id_menu' => $menu,
            'libelle' => $lib,
            'etat' => $etat
        ];
        $sous_M->insert($donnee);
        return redirect()->to(site_url('sous_menu'));
    }

    public function EditSous_menu()
    {
        $id = $this->request->getPost('id');
        $code = $this->request->getPost('code');
        $lib = $this->request->getPost('libelle');
        $menu = $this->request->getPost('menu');
        if ($id) {
            $sous_M = new Sous_menuModel();
            $data = $sous_M->find($id);
            if ($data) {
                $donnee = ['code' => $code, 'libelle' => $lib, 'id_menu' => $menu];
                $sous_M->update($id, $donnee);
            }
        }
        return redirect()->to(site_url('sous_menu'));
    }

    public function DeleteSous_menu($id = null)
    {
        if ($id != null) {
            $sous_M = new Sous_menuModel();
            $sous_M->delete($id);
        }
        return redirect()->to(site_url('sous_menu'));
    }


    //========= Gestion JSON ==========

    //Get /sous-menu
    /**
     * @OA\Get(
     *     path="/sous-menu",
     *     tags={"Sous-menu"},
     *     summary="Afficher tous les Sous-menus",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des Sous-menus"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Aucun Sous-menu trouvé"
     *     )
     * )
     */
    public function AfficherSousMenuJson()
    {
        $sousMen = new Sous_menuModel();
        $donnee['sous_menu'] = $sousMen->findAll();
        return $this->response->setJSON($donnee)->setStatusCode(200);
    }

    //Get /sous-menu/{id}
    /**
     * @OA\Get(
     *     path="/sous-menu/{id}",
     *     tags={"Sous-menu"},
     *     summary="Afficher un sous-menu par son ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID du sous-menu",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Sous-menu trouvé"),
     *     @OA\Response(response=404, description="Sous-menu non trouvé")
     * )
     */
    public function AfficherSousMenuByIdJson($id = null)
    {
        $sousMen = new Sous_menuModel();
        $donnee = $sousMen->find($id);

        if (!$donnee) {
            return $this->response
                ->setJSON(['message' => "Sous-menu avec ID $id non trouvé"])
                ->setStatusCode(404);
        }
        return $this->response->setJSON($donnee)->setStatusCode(200);
    }

    //Post /sous-menu
    /**
     * @OA\Post(
     *     path="/sous-menu",
     *     tags={"Sous-menu"},
     *     summary="Ajouter un sous-menu",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="code", type="string", example="SM001"),
     *             @OA\Property(property="libelle", type="string", example="Sous-menu Utilisateurs"),
     *             @OA\Property(property="id_menu", type="integer", example=2, description="ID du menu parent"),
     *             @OA\Property(property="etat", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Sous-menu crée"),
     *     @OA\Response(response=400, description="Données invalides")
     * )
     */
    public function AjoutSousMenuJson()
    {
        $sousMen = new Sous_menuModel();
        $donnee = $this->request->getJSON(true);

        if (empty($donnee['id_menu'])) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['message' => 'id_menu est obligatoire']);
        }

        $sousMen->insert([
            'code' => $donnee['code'] ?? null,
            'libelle' => $donnee['libelle'] ?? null,
            'id_menu' => $donnee['id_menu'],
            'etat' => $donnee['etat'] ?? 1
        ]);

        return $this->response
            ->setStatusCode(201)
            ->setJSON(['message' => 'Sous-menu créé avec succès']);
    }

    //Put /sous-menu/{id}
    /**
     * @OA\Put(
     *     path="/sous-menu/{id}",
     *     tags={"Sous-menu"},
     *     summary="Modifier un sous-menu",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID du sous-menu",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="code", type="string", example="SM001"),
     *             @OA\Property(property="libelle", type="string", example="Sous-menu Utilisateurs"),
     *             @OA\Property(property="id_menu", type="integer", example=2, description="ID du menu parent"),
     *             @OA\Property(property="etat", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Sous-menu modifié"),
     *     @OA\Response(response=404, description="Sous-menu non trouvé")
     * )
     */
    public function EditSousMenuJson($id = null)
    {
        $sousMen = new Sous_menuModel();
        $exist = $sousMen->find($id);

        if (!$exist) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['message' => "Sous-menu avec ID $id non trouvé"]);
        }

        $donnee = $this->request->getJSON(true);
        $data = [
            'code' => $donnee['code'] ?? $exist['code'],
            'libelle' => $donnee['libelle'] ?? $exist['libelle'],
            'id_menu' => $donnee['id_menu'] ?? $exist['id_menu'],
            'etat' => $donnee['etat'] ?? $exist['etat']
        ];

        $sousMen->update($id, $data);
        return $this->response->setStatusCode(200)->setJSON(['message' => 'Sous-menu modifié']);
    }

    //Delete /sous-menu/{id}
    /**
     * @OA\Delete(
     *     path="/sous-menu/{id}",
     *     tags={"Sous-menu"},
     *     summary="Supprimer un sous-menu",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID du sous-menu",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Sous-menu supprimé"),
     *     @OA\Response(response=404, description="Sous-menu non trouvé")
     * )
     */
    public function DeleteSousMenuJson($id = null)
    {
        $sousMen = new Sous_menuModel();
        $exist = $sousMen->find($id);

        if (!$exist) {
            return $this->response->setJSON(['message' => "Sous-menu avec ID $id non trouvé"])->setStatusCode(404);
        }

        $sousMen->delete($id);
        return $this->response->setJSON(['message' => 'Sous-menu supprimé'])->setStatusCode(200);
    }
}


