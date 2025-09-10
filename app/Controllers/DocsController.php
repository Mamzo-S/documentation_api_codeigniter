<?php

namespace App\Controllers;
// require 'vendor/autoload.php';
use OpenApi\Generator;

/**
 * @OA\Info(
 *     title="API SIMEN",
 *     version="1.0.0",
 *     description="Documentation API SIMEN"
 * )
 * 
 * @OA\Server(
 *     url="http://localhost/documentation_api_codeigniter",
 *     description="Serveur local"
 * )
 */

class DocsController extends BaseController
{
    public function swagg()
    {
        $openapi = Generator::scan([APPPATH . 'Controllers']);
        // var_dump($openapi);
        // echo json_encode($openapi);
        // exit;
        // exit;
        header('Content-Type: application/json');
        echo $openapi->toJSON();
        exit;
    }
}

?>