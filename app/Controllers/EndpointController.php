<?php

namespace App\Controllers;

use App\Models\EndpointModel;
use App\Models\LienModel;
use App\Models\MethodeModel;

class EndpointController extends BaseController{

    public function AfficherEndpoints(){
        $endpoint = new EndpointModel();
        $lien = new LienModel();
        $methode = new MethodeModel();
        $donnee ['methode'] = $methode->findAll();
        $donnee ['endpoint'] = $endpoint->AfficherEndpoints();
        $donnee ['lien'] = $lien->findAll();
        return view('endpoints', $donnee);
    }


}