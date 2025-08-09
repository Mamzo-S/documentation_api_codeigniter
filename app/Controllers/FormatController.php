<?php

namespace App\Controllers;

use App\Models\FormatModel;

class FormatController extends BaseController{

    public function AfficherFormat(){
        $lien = new FormatModel();
        $donnee ['format'] = $lien->findAll();
        return view('format_donnee', $donnee);
    }

}