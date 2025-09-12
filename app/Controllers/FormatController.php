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
        // return $this->response->setJSON($donnee);
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
}
