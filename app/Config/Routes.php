<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('index', 'Home::index');
$routes->get('endpoints', 'EndpointController::AfficherEndpoints');
$routes->get('architecture', 'ArchitectureController::AfficherArchitecture');
$routes->get('authentification', 'AuthentificationController::AfficherAuthentification');
$routes->post('AjoutAuthentification', 'AuthentificationController::AjoutAuthentification');
$routes->get('DeleteAuthentification/(:num)', 'AuthentificationController::DeleteAuthentification/$1');
$routes->post('EditAuthentification', 'AuthentificationController::EditAuthentification');
$routes->get('methode', 'MethodeController::AfficherMethode');
$routes->get('format_donnee', 'FormatController::AfficherFormat');
$routes->get('base_url', 'LienController::AfficherLien');
