<?php

namespace App\Controllers;

use App\Models\M_menu;
use App\Models\M_profil;
use App\Models\M_sousMenu;

class C_profil extends BaseController
{

    public function AfficherProfil()
    {
        $prof = new M_profil();
        $menuM = new M_menu();
        $sousmenuM = new M_sousMenu();

        $donnee['menu'] = $menuM->findAll();
        $donnee['profil'] = $prof->findAll();

        foreach ($donnee['menu'] as &$m) {
            $m['sous_menu'] = $sousmenuM->getSousMenuByIdMenu($m['id']);
        }
        return view('V_gestionProfil', $donnee);
    }

    public function AjoutProfil()
    {
        $prof = new M_profil();
        $profil = $this->request->getPost('profil');
        $donnee = ['profile_name' => $profil];
        $prof->insert($donnee);
        return redirect()->to(site_url('gestionProfil'));
    }

    public function EditProfil()
    {
        $id = $this->request->getPost('id');
        $profil = $this->request->getPost('profil');
        if ($id) {
            $prof = new M_profil();
            $data = $prof->find($id);
            if ($data) {
                $donnee = ['profile_name' => $profil];
                $prof->update($id, $donnee);
            }
        }
        return redirect()->to(site_url('gestionProfil'));
    }

    public function DeleteProfil($id = null)
    {
        if ($id != null) {
            $prof = new M_profil();
            $prof->delete($id);
        }
        return redirect()->to(site_url('gestionProfil'));
    }

    
  //========Gestion Endpoint avec format JSON============
    //Get /profil
    /**
     * @OA\Get(
     *     path="/profil",
     *     tags={"Profil"},
     *     summary="Afficher tous les profils",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des menus"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Aucun profil trouvé"
     *     )
     * )
     */
    public function AfficherProfilJson()
    {
        $profil = new M_profil();
        $donnee['menu'] = $profil->findAll();
        return view('menu', $donnee);
    }



    //Get /profil/{id}
    /**
     * @OA\Get(
     *      path="/profil/{id}",
     *      tags={"Profil"},
     *      summary="Afficher un profil par son ID",
     *      @OA\Parameter(
     *              name="id",
     *              in="path",
     *              required=true,
     *              description="ID du profil",
     *              @OA\Schema(type="integer")
     *          ),
     *      @OA\Response(
     *            response=200,
     *            description="Profil trouvé"),
     *      @OA\Response(response=400, description="Profil non trouvé")   
     * )
     */

    public function AfficherProfilByIdJson($id = null)
    {
        $profil = new M_profil();
        $donnee = $profil->find($id);

        if (!$donnee) {
            return $this->response
                ->setJSon(['message' => "Profil avec ID $id non trouvé"])
                ->setStatusCode(404);
        }
        return $this->response
            ->setJSON($donnee)
            ->setStatusCode(200);
    }

    //Post /profil
    /**
     * @OA\Post(
     *      path="/profil",
     *      tags={"Profil"},
     *      summary="Ajouter un profil",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="profil_name", type="string", example="Administrateur"),    
     *          )
     *        ),
     *      @OA\Response(response=201, description="Profil crée"),
     *      @OA\Response(response=400, description="Données invalides")
     *)
     */

    public function AjoutProfilJson()
    {
        $profil = new M_profil();
        $donnee = $this->request->getJSON(true);
        $profil->insert([
            'profil_name' => $donnee['profil_name'] ?? null
            
        ]);
        return $this->response
            ->setStatusCode(201)
            ->setJSON(['message' => 'Profil créer avec succés']);
    }


    //Put /profil/{id}
    /**
     * @OA\Put(
     *     path="/profil/{id}",
     *     tags={"Profil"},
     *     summary="Modifier un profil",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Id du profil",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="profil_name", type="string", example="Adminitrateur"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Profil modifié"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Profil non trouvé"
     *     )
     * )
     */


    public function EditProfilJson($id = null)
    {
        $profil = new M_profil();

        $exist = $profil->find($id);

        if (!$exist) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['message' => "Profil avec ID $id non trouvé"]);
        }
        $donnee = $this->request->getJSON(true);
        $data = [
            'code' => $donnee['code'] ?? $exist['code']
        ];

        $profil->update($id, $data);

        return $this->response
            ->setStatusCode(200)
            ->setJSON(['message' => 'Profil modifié']);
    }
    //Delete /profil/{id}
     /**
     * @OA\Delete(
     *     path="/profil/{id}",
     *     tags={"Profil"},
     *     summary="Supprimer un profil",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID du menu",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Profil supprimé"),
     *     @OA\Response(response=404, description="Profil non trouvé")
     * )
     */
    public function DeleteProfilJson($id = null)
    {
        $profil = new M_profil();
        $exist = $profil->find($id);

        if (!$exist) {
            return $this->response
                ->setJSON(['message' => "Profil avec ID $id non trouvé"])
                ->setStatusCode(404);
        }

        $profil->delete($id);
        return $this->response
            ->setJSON(['message' => 'Profil supprimé'])
            ->setStatusCode(200);
    }
}