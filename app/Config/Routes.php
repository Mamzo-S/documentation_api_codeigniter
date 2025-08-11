<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('index', 'Home::index');

//endpoints
$routes->get('endpoints', 'EndpointController::AfficherEndpoints');
$routes->post('AjoutEndpoint', 'EndpointController::AjoutEndpoint');
$routes->get('DeleteEndpoint/(:num)', 'EndpointController::DeleteEndpoint/$1');
$routes->post('EditEndpoint', 'EndpointController::EditEndpoint');

//architecture
$routes->get('architecture', 'ArchitectureController::AfficherArchitecture');
$routes->post('AjoutArchitecture', 'ArchitectureController::AjoutArchitecture');
$routes->get('DeleteArchitecture/(:num)', 'ArchitectureController::DeleteArchitecture/$1');
$routes->post('EditArchitecture', 'ArchitectureController::EditArchitecture');

//authentification
$routes->get('authentification', 'AuthentificationController::AfficherAuthentification');
$routes->post('AjoutAuthentification', 'AuthentificationController::AjoutAuthentification');
$routes->get('DeleteAuthentification/(:num)', 'AuthentificationController::DeleteAuthentification/$1');
$routes->post('EditAuthentification', 'AuthentificationController::EditAuthentification');

//methode
$routes->get('methode', 'MethodeController::AfficherMethode');
$routes->post('AjoutMethode', 'MethodeController::AjoutMethode');
$routes->post('EditMethode', 'MethodeController::EditMethode');
$routes->get('DeleteMethode/(:num)', 'MethodeController::DeleteMethode/$1');

//format de donnee
$routes->get('format_donnee', 'FormatController::AfficherFormat');
$routes->post('AjoutFormat', 'FormatController::AjoutFormat');
$routes->post('EditFormat', 'FormatController::EditFormat');
$routes->get('DeleteFormat/(:num)', 'FormatController::DeleteFormat/$1');

//base url
$routes->get('base_url', 'LienController::AfficherLien');
$routes->post('AjoutLien', 'LienController::AjoutLien');
$routes->post('EditLien', 'LienController::EditLien');
$routes->get('DeleteLien/(:num)', 'LienController::DeleteLien/$1');

