<?php

namespace App\Controllers;

use App\Models\LienModel;

class LienController extends BaseController{

    public function AfficherLien(){
        $lien = new LienModel();
        $donnee ['lien'] = $lien->findAll();
        return view('base_url', $donnee);
    }

}