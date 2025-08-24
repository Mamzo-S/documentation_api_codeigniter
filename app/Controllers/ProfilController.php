<?php

namespace App\Controllers;

use App\Models\ProfilModel;
use App\Models\Sous_menuModel;
use App\Models\MenuModel;

class ProfilController extends BaseController
{

    public function AfficherProfil()
    {
        $prof = new ProfilModel();
        $menuM = new MenuModel();
        $sousmenuM = new Sous_menuModel();

        $donnee['menu'] = $menuM->findAll();
        $donnee['profil'] = $prof->findAll();

        foreach ($donnee['menu'] as &$m) {
            $m['sous_menus'] = $sousmenuM->getSousMenuByIdMenu($m['id']);
        }
        return view('gestionProfil', $donnee);
    }

    public function AjoutProfil()
    {
        $prof = new ProfilModel();
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
            $prof = new ProfilModel();
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
            $prof = new ProfilModel();
            $prof->delete($id);
        }
        return redirect()->to(site_url('gestionProfil'));
    }
}
