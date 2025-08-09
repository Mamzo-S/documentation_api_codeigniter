<?php

namespace App\Controllers;

use App\Models\MethodeModel;

class MethodeController extends BaseController{

    public function AfficherMethode(){
        $lien = new MethodeModel();
        $donnee ['methode'] = $lien->findAll();
        return view('methode', $donnee);
    }

}