<?php

namespace App\Controllers;

use App\Models\MethodeModel;

class MethodeController extends BaseController
{

    /**
     * @OA\Get(
     *     path="/methode",
     *     summary="Obtenir la liste de toutes les méthodes",
     *     tags={"Methodes"},
     *     @OA\Response(
     *         response=200,
     *         description="Liste des méthodes obtenue avec succès",
     *     )
     * )
     */
    public function AfficherMethode()
    {
        $lien = new MethodeModel();
        $donnee['methode'] = $lien->findAll();
        // return view('methode', $donnee);
        return $this->response->setJSON($donnee);
    }

    public function AjoutMethode()
    {
        $methode = new MethodeModel();
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
            $methode = new MethodeModel();
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
            $methode = new MethodeModel();
            $methode->delete($id);
        }
        return redirect()->to(site_url('methode'));
    }
}
