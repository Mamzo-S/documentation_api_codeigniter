<?php

namespace App\Controllers;

use App\Models\ArchitectureModel;
use App\Models\FormatModel;

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
}
