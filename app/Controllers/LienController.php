<?php

namespace App\Controllers;

use App\Models\LienModel;

class LienController extends BaseController
{

    /**
     * @OA\Get(
     *     path="/base_url",
     *     tags={"Base url"},
     *     summary="Afficher tous les liens",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des bases url"
     *     )
     * )
     */
    public function AfficherLien()
    {
        $lien = new LienModel();
        $donnee['lien'] = $lien->findAll();
        return view('base_url', $donnee);
    }

    public function AjoutLien()
    {
        $lien = new LienModel();
        $base_url = $this->request->getPost('lien');
        $donnee = ['base_url' => $base_url];
        $lien->insert($donnee);
        return redirect()->to(site_url('base_url'));
    }

    public function EditLien()
    {
        $id = $this->request->getPost('id');
        $base_url = $this->request->getPost('lien');
        if ($id) {
            $lien = new LienModel();
            $data = $lien->find($id);
            if ($data) {
                $donnee = ['base_url' => $base_url];
                $lien->update($id, $donnee);
            }
        }
        return redirect()->to(site_url('base_url'));
    }

    public function DeleteLien($id = null)
    {
        if ($id != null) {
            $lien = new LienModel();
            $lien->delete($id);
        }
        return redirect()->to(site_url('base_url'));
    }
}
