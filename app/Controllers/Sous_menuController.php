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
        $donnee = ['code' => $code,'id_menu' =>$menu,
                    'libelle' => $lib, 'etat' => $etat];
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
}
