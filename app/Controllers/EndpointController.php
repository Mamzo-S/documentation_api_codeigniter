<?php

namespace App\Controllers;

use App\Models\EndpointModel;
use App\Models\LienModel;
use App\Models\MethodeModel;

class EndpointController extends BaseController
{
    public function AfficherEndpoints()
    {
        $endpoint = new EndpointModel();
        $lien = new LienModel();
        $methode = new MethodeModel();
        $donnee['methode'] = $methode->findAll();
        $donnee['endpoint'] = $endpoint->AfficherEndpoints();
        $donnee['lien'] = $lien->findAll();
        return view('endpoints', $donnee);
    }

    public function AjoutEndpoint()
    {
        $lien = $this->request->getPost('lien');
        $param = $this->request->getPost('param');
        $methode = $this->request->getPost('meth');
        $rep = $this->request->getPost('rep');
        $end = new EndpointModel();
        $donnee = [
            'lien_end' => $lien,
            'parametre' => $param,
            'methode_end' => $methode,
            'reponse' => $rep
        ];
        $end->insert($donnee);
        return redirect()->to(site_url('endpoints'));
    }

    public function DeleteEndpoint($id = null)
    {
        if ($id != null) {
            $end = new EndpointModel();
            $end->delete($id);
        }
        return redirect()->to(site_url('endpoints'));
    }

    public function EditEndpoint()
    {
        $id = $this->request->getPost('id');
        $methode = $this->request->getPost('meth');
        $lien = $this->request->getPost('lien');
        $param = $this->request->getPost('param');
        $rep = $this->request->getPost('rep');

        if ($id) {
            $end = new EndpointModel();
            $data = $end->find($id);

            if ($data) {
                $donnee = [
                    'lien_end' => $lien,
                    'parametre' => $param,
                    'methode_end' => $methode,
                    'reponse' => $rep,
                ];
                $end->update($id, $donnee);
            }
        }
        return redirect()->to(site_url('endpoints'));
    }
}
