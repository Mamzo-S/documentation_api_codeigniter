<?php

namespace App\Controllers;

use App\Models\ArchitectureModel;
use App\Models\FormatModel;

class ArchitectureController extends BaseController{

    public function AfficherArchitecture(){
        $archi = new ArchitectureModel();
        $format = new FormatModel();
        $donnee ['format'] = $format->findAll();
        $donnee ['archi'] = $archi->AfficherArchitecture();
        return view('architecture', $donnee);
    }


}