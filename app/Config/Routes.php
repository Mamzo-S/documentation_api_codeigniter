<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('index', 'Home::index');
$routes->get('swagger', 'Home::swagger');
$routes->get('swagg', 'DocsController::swagg');

// $routes->get(from: '/', 'Home::index');
$routes->post('login', 'UserController::login');
$routes->get('login', 'UserController::loginform');
$routes->get('logout', 'UserController::logout');

//endpoints
$routes->get('endpoint', 'EndpointController::AfficherEndpointJson');
$routes->get('endpoint/(:num)', 'EndpointController::AfficherEndpointByIdJson/$1');
$routes->post('endpoint', 'EndpointController::AjoutEndpointJson');
$routes->put('endpoint/(:num)', 'EndpointController::EditEndpointJson/$1');
$routes->delete('endpoint/(:num)', 'EndpointController::DeleteEndpointJson/$1');




//
$routes->get('endpoints', 'EndpointController::AfficherEndpoints');
$routes->post('AjoutEndpoint', 'EndpointController::AjoutEndpoint');
$routes->get('DeleteEndpoint/(:num)', 'EndpointController::DeleteEndpoint/$1');
$routes->post('EditEndpoint', 'EndpointController::EditEndpoint');

//architecture avec json
$routes->get('architectures', 'ArchitectureController::AfficherArchitectureJson');
$routes->get('architectures/(:num)', 'ArchitectureController::AfficherArchitectureById/$1');
$routes->delete('architectures/(:num)', 'ArchitectureController::DeleteArchitectureJson/$1');
$routes->post('architectures', 'ArchitectureController::AjoutArchitectureJson');
$routes->put('architectures/(:num)', 'ArchitectureController::EditArchitectureJson/$1');
//architecture sans json
$routes->get('architecture', 'ArchitectureController::AfficherArchitecture');
$routes->post('AjoutArchitecture', 'ArchitectureController::AjoutArchitecture');
$routes->get('DeleteArchitecture/(:num)', 'ArchitectureController::DeleteArchitecture/$1');
$routes->post('EditArchitecture', 'ArchitectureController::EditArchitecture');

//authentification avec json
$routes->get('authentifications', 'AuthentificationController::AfficherAuthentificationJson');
$routes->get('authentifications/(:num)', 'AuthentificationController::AfficherAuthentificationById/$1');
$routes->delete('authentifications/(:num)', 'AuthentificationController::DeleteAuthentificationJson/$1');
$routes->post('authentifications', 'AuthentificationController::AjoutAuthentificationJson');
$routes->put('authentifications/(:num)', 'AuthentificationController::EditAuthentificationJson/$1');
//authentification sans json
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
//base url avec json
$routes->get('lien', 'LienController::AfficherLienJson');
$routes->get('lien/(:num)', 'LienController::AfficherLienById/$1');
$routes->delete('lien/(:num)', 'LienController::DeleteLienJson/$1');
$routes->post('lien', 'LienController::AjoutLienJson');
$routes->put('lien/(:num)', 'LienController::EditLienJson/$1');

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


