<?php

namespace App\Controllers;

use App\Models\AuthentificationModel;
use App\Models\LienModel;
use App\Models\MethodeModel;

class AuthentificationController extends BaseController
{

    public function AfficherAuthentification()
    {
        $auth = new AuthentificationModel();
        $lien = new LienModel();
        $methode = new MethodeModel();
        $donnee['methode'] = $methode->find();
        $donnee['lien'] = $lien->findAll();
        $donnee['auth'] = $auth->AfficherAuthentification();
        return view('authentification', $donnee);
    }

    public function AjoutAuthentification()
    {
        $methode = $this->request->getPost('meth');
        $lien = $this->request->getPost('lien');
        $body = $this->request->getPost('body');
        $auth = new AuthentificationModel();
        $donnee = [
            'methode_auth' => $methode,
            'lien_auth' => $lien,
            'body' => $body
        ];
        $auth->insert($donnee);
        return redirect()->to(site_url('authentification'));
    }

    public function DeleteAuthentification($id = null)
    {
        if ($id != null) {
            $auth = new AuthentificationModel();
            $auth->delete($id);
        }
        return redirect()->to(site_url('authentification'));
    }

    public function EditAuthentification()
    {
        $id = $this->request->getPost('id');
        $methode = $this->request->getPost('meth');
        $lien = $this->request->getPost('lien');
        $body = $this->request->getPost('body');

        if ($id) {
            $auth = new AuthentificationModel();
            $data = $auth->find($id);

            if ($data) {
                $donnee = [
                    'methode_auth' => $methode,
                    'lien_auth' => $lien,
                    'body' => $body
                ];
                $auth->update($id, $donnee);
            }
        }

        return redirect()->to(site_url('authentification'));
    }
}
