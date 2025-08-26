<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('index', 'Home::index');

$routes->get('/', 'UserController::loginform');
$routes->post('login', 'UserController::login'); 
$routes->get('login', 'UserController::loginform'); 
$routes->get('logout', 'UserController::logout');

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

//utilisateur
$routes->get('gestionUtilisateur', 'UserController::AfficherUser');
$routes->post('AjoutUser', 'UserController::AjoutUser');
$routes->get('DeleteUser/(:num)', 'UserController::DeleteUser/$1');
$routes->post('EditUser', 'UserController::EditUser');
$routes->get('ChangeStatut/(:num)', 'UserController::ChangeStatut/$1');
$routes->get('SendEmail/(:num)', 'UserController::SendEmail/$1');


//profil
$routes->get('gestionProfil', 'ProfilController::AfficherProfil');
$routes->post('AjoutProfil', 'ProfilController::AjoutProfil');
$routes->get('DeleteProfil/(:num)', 'ProfilController::DeleteProfil/$1');
$routes->post('EditProfil', 'ProfilController::EditProfil');

//menu
$routes->get('menu', 'MenuController::AfficherMenu');
$routes->post('AjoutMenu', 'MenuController::AjoutMenu');
$routes->get('DeleteMenu/(:num)', 'MenuController::DeleteMenu/$1');
$routes->post('EditMenu', 'MenuController::EditMenu');

//sous_menu
$routes->get('sous_menu', 'Sous_menuController::AfficherSous_menu');
$routes->post('AjoutSous_menu', 'Sous_menuController::AjoutSous_menu');
$routes->get('DeleteSous_menu/(:num)', 'Sous_menuController::DeleteSous_menu/$1');
$routes->post('EditSous_menu', 'Sous_menuController::EditSous_menu');

//role
$routes->post('SaveRole', 'RoleController::SaveRole');
