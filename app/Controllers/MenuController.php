<?php

namespace App\Controllers;

use App\Models\MenuModel;

class MenuController extends BaseController
{

    public function AfficherMenu()
    {
        $Men = new MenuModel();
        $donnee['menu'] = $Men->findAll();
        return view('menu', $donnee);
    }

    public function AjoutMenu()
    {
        $Men = new MenuModel();
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
            $Men = new MenuModel();
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
            $Men = new MenuModel();
            $Men->delete($id);
        }
        return redirect()->to(site_url('menu'));
    }
}
