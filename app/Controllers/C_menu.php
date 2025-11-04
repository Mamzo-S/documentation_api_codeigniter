<?php

namespace App\Controllers;

use App\Models\M_menu;
use CodeIgniter\Annotation as OA;

class C_menu extends BaseController
{
    public function AfficherMenu()
    {
        $Men = new M_menu();
        $donnee['menu'] = $Men->findAll();
        return view('V_menu', $donnee);
    }
    public function AjoutMenu()
    {
        $Men = new M_menu();
        $code = $this->request->getPost('code');
        $lib = $this->request->getPost('libelle');
        $etat = 1;
        $donnee = ['code' => $code, 'libelle' => $lib, 'etat' => $etat];
        $Men->insert($donnee);
        return redirect()->to(site_url('menu'));
    }

    public function EditMenu()
    {
        $id = $this->request->getPost('id');
        $code = $this->request->getPost('code');
        $lib = $this->request->getPost('libelle');
        if ($id) {
            $Men = new M_menu();
            $data = $Men->find($id);
            if ($data) {
                $donnee = ['code' => $code, 'libelle' => $lib];
                $Men->update($id, $donnee);
            }
        }
        return redirect()->to(site_url('menu'));
    }

    public function DeleteMenu($id = null)
    {
        if ($id != null) {
            $Men = new M_menu();
            $Men->delete($id);
        }
        return redirect()->to(site_url('menu'));
    }

    //========Gestion Menu avec format JSON============
    //Get /menu
    /**
     * @OA\Get(
     *     path="/menu",
     *     tags={"Menu"},
     *     summary="Afficher tous les menus",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des menus"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Aucun menu trouvé"
     *     )
     * )
     */
    public function AfficherMenuJson()
    {
        $Men = new M_menu();
        $donnee['menu'] = $Men->findAll();
        return view('menu', $donnee);
    }



    //Get /menu/{id}
    /**
     * @OA\Get(
     *      path="/menu/{id}",
     *      tags={"Menu"},
     *      summary="Afficher un menu par son ID",
     *      @OA\Parameter(
     *              name="id",
     *              in="path",
     *              required=true,
     *              description="ID du menu",
     *              @OA\Schema(type="integer")
     *          ),
     *      @OA\Response(
     *            response=200,
     *            description="Menu trouvé"),
     *      @OA\Response(response=400, description="Menu non trouvé")   
     * )
     */

    public function AfficherMenuByIdJson($id = null)
    {
        $men = new M_menu();
        $donnee = $men->find($id);

        if (!$donnee) {
            return $this->response
                ->setJSon(['message' => "Menu avec ID $id non trouvé"])
                ->setStatusCode(404);
        }
        return $this->response
            ->setJSON($donnee)
            ->setStatusCode(200);
    }

    //Post /menu
    /**
     * @OA\Post(
     *      path="/menu",
     *      tags={"Menu"},
     *      summary="Ajouter un menu",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="code", type="string", example="Accueil"),
     *              @OA\Property(property="libelle", type="string", example="Menu principal"),
     *              @OA\Property(property="etat", type="integer", example=1)
     *          )
     *        ),
     *      @OA\Response(response=201, description="Menu crée"),
     *      @OA\Response(response=400, description="Données invalides")
     *)
     */

    public function AjoutMenuJson()
    {
        $men = new M_menu();
        $donnee = $this->request->getJSON(true);
        $men->insert([
            'code' => $donnee['code'] ?? null,
            'libelle' => $donnee['libelle'] ?? null,
            'etat' => $donnee['etat'] ?? 1  // etat=1 par defaut si $donnee['etat'] est null
        ]);
        return $this->response
            ->setStatusCode(201)
            ->setJSON(['message' => 'Menu créer avec succés']);
    }


    //Put /Menu/{id}
    /**
     * @OA\Put(
     *     path="/menu/{id}",
     *     tags={"Menu"},
     *     summary="Modifier un menu",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Id du menu",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="code", type="string", example="Accueil"),
     *             @OA\Property(property="libelle", type="string", example="Menu principal"),
     *             @OA\Property(property="etat", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Menu modifié"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Menu non trouvé"
     *     )
     * )
     */


    public function EditMenuJson($id = null)
    {
        $men = new M_menu();

        $exist = $men->find($id);

        if (!$exist) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['message' => "Menu avec ID $id non trouvé"]);
        }
        $donnee = $this->request->getJSON(true);
        $data = [
            'code' => $donnee['code'] ?? $exist['code'],
            'libelle' => $donnee['libelle'] ?? $exist['libelle'],
            'etat' => $donnee['etat'] ?? $exist['etat']
        ];

        $men->update($id, $data);

        return $this->response
            ->setStatusCode(200)
            ->setJSON(['message' => 'Menu modifié']);
    }
    //Delete /menu/{id}
    /**
     * @OA\Delete(
     *     path="/menu/{id}",
     *     tags={"Menu"},
     *     summary="Supprimer un menu",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID du menu",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Menu supprimé"),
     *     @OA\Response(response=404, description="Menu non trouvé")
     * )
     */
    public function DeleteMenuJson($id = null)
    {
        $men = new M_menu();
        $exist = $men->find($id);

        if (!$exist) {
            return $this->response
                ->setJSON(['message' => "Menu avec ID $id non trouvé"])
                ->setStatusCode(404);
        }

        $men->delete($id);
        return $this->response
            ->setJSON(['message' => 'Menu supprimé'])
            ->setStatusCode(200);
    }
}