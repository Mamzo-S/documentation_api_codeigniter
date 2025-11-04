<?php

namespace App\Controllers;

use App\Models\M_role;

class C_role extends BaseController
{
    public function SaveRole()
    {
        $roleModel = new M_role();

        $profil_id = $this->request->getPost('profil');
        $read = $this->request->getPost('read') ?? [];
        $add = $this->request->getPost('add') ?? [];
        $upd = $this->request->getPost('upd') ?? [];
        $del = $this->request->getPost('del') ?? [];

        $allSm = array_unique(
            array_merge(
                array_keys($read),
                array_keys($add),
                array_keys($upd),
                array_keys($del)
            )
        );

        foreach ($allSm as $sm) {
            $data = [
                'd_read' => isset($read[$sm]) ? 1 : 0,
                'd_add' => isset($add[$sm]) ? 1 : 0,
                'd_upd' => isset($upd[$sm]) ? 1 : 0,
                'd_del' => isset($del[$sm]) ? 1 : 0,
                'profil_id' => $profil_id,
                'id_sousmenu' => $sm,
            ];

            // on verifie déjà si ca existe dans la base de donnee
            $existe = $roleModel
                ->where('profil_id', $profil_id)
                ->where('id_sousmenu', $sm)
                ->first();

            if ($existe) {
                $roleModel->update($existe['id'], $data);
            } else {
                $roleModel->insert($data);
            }
        }
        return redirect()->to(site_url('gestionProfil'));
    }

    public function getRolesByProfile($profil_id)
    {
        $roleModel = new M_role();
        $roles = $roleModel->where('profil_id', $profil_id)->findAll();
        return $this->response->setJSON($roles);
    }

}