<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('index', 'Home::index');
$routes->get('swagger', 'Home::swagger');
$routes->get('swagg', 'C_docs::swagg');

// $routes->get(from: '/', 'Home::index');
$routes->post('login', 'C_user::login');
$routes->get('login', 'C_user::loginform');
$routes->get('logout', 'C_user::logout');

//endpoints format json
// $routes->get('endpoint', 'C_endpoint::AfficherEndpointJson');
// $routes->get('endpoint/(:num)', 'C_endpoint::AfficherEndpointByIdJson/$1');
// $routes->post('endpoint', 'C_endpoint::AjoutEndpointJson');
// $routes->put('endpoint/(:num)', 'C_endpoint::EditEndpointJson/$1');
// $routes->delete('endpoint/(:num)', 'C_endpoint::DeleteEndpointJson/$1');


//endpoint 
$routes->get('endpoints', 'C_endpoint::AfficherEndpoints');
$routes->post('AjoutEndpoint', 'C_endpoint::AjoutEndpoint');
$routes->get('DeleteEndpoint/(:num)', 'C_endpoint::DeleteEndpoint/$1');
$routes->post('EditEndpoint', 'C_endpoint::EditEndpoint');

//architecture avec json
// $routes->get('architectures', 'C_architecture::AfficherArchitectureJson');
// $routes->get('architectures/(:num)', 'C_architecture::AfficherArchitectureById/$1');
// $routes->delete('architectures/(:num)', 'C_architecture::DeleteArchitectureJson/$1');
// $routes->post('architectures', 'C_architecture::AjoutArchitectureJson');
// $routes->put('architectures/(:num)', 'C_architecture::EditArchitectureJson/$1');
// architecture sans json
$routes->get('architecture', 'C_architecture::AfficherArchitecture');
$routes->post('AjoutArchitecture', 'C_architecture::AjoutArchitecture');
$routes->get('DeleteArchitecture/(:num)', 'C_architecture::DeleteArchitecture/$1');
$routes->post('EditArchitecture', 'C_architecture::EditArchitecture');

//methode
$routes->get('methode', 'C_methode::AfficherMethode');
$routes->post('AjoutMethode', 'C_methode::AjoutMethode');
$routes->post('EditMethode', 'C_methode::EditMethode');
$routes->get('DeleteMethode/(:num)', 'C_methode::DeleteMethode/$1');
//methode avec json
// $routes->get('methodes', 'C_methode::AfficherMethodeJson');
// $routes->get('methodes/(:num)', 'C_methode::AfficherMethodeById/$1');
// $routes->delete('methodes/(:num)', 'C_methode::DeleteMethodeJson/$1');
// $routes->post('methodes', 'C_methode::AjoutMethodeJson');
// $routes->put('methodes/(:num)', 'C_methode::EditMethodeJson/$1');

//format de donnee
$routes->get('format_donnee', 'C_format::AfficherFormat');
$routes->post('AjoutFormat', 'C_format::AjoutFormat');
$routes->post('EditFormat', 'C_format::EditFormat');
$routes->get('DeleteFormat/(:num)', 'C_format::DeleteFormat/$1');
//format de donnee avec json
// $routes->get('format', 'C_format::AfficherFormatJson');
// $routes->get('format/(:num)', 'C_format::AfficherFormatById/$1');
// $routes->delete('format/(:num)', 'C_format::DeleteFormatJson/$1');
// $routes->post('format', 'C_format::AjoutFormatJson');
// $routes->put('format/(:num)', 'C_format::EditFormatJson/$1');

//base url
$routes->get('base_url', 'C_lien::AfficherLien');
$routes->post('AjoutLien', 'C_lien::AjoutLien');
$routes->post('EditLien', 'C_lien::EditLien');
$routes->get('DeleteLien/(:num)', 'C_lien::DeleteLien/$1');
//base url avec json
// $routes->get('lien', 'C_lien::AfficherLienJson');
// $routes->get('lien/(:num)', 'C_lien::AfficherLienById/$1');
// $routes->delete('lien/(:num)', 'C_lien::DeleteLienJson/$1');
// $routes->post('lien', 'C_lien::AjoutLienJson');
// $routes->put('lien/(:num)', 'C_lien::EditLienJson/$1');

//utilisateur
$routes->get('gestionUtilisateur', 'C_user::AfficherUser');
$routes->post('AjoutUser', 'C_user::AjoutUser');
$routes->get('DeleteUser/(:num)', 'C_user::DeleteUser/$1');
$routes->post('EditUser', 'C_user::EditUser');
$routes->get('ChangeStatut/(:num)', 'C_user::ChangeStatut/$1');
$routes->get('SendEmail/(:num)', 'C_user::SendEmail/$1');
//users avec json
// $routes->get('user', 'C_user::AfficherUserJson');
// $routes->get('user/(:num)', 'C_user::AfficherUserById/$1');
// $routes->delete('user/(:num)', 'C_user::DeleteUserJson/$1');
// $routes->post('user', 'C_user::AjoutUserJson');
// $routes->put('user/(:num)', 'C_user::EditUserJson/$1');

//profil
$routes->get('gestionProfil', 'C_profil::AfficherProfil');
$routes->post('AjoutProfil', 'C_profil::AjoutProfil');
$routes->get('DeleteProfil/(:num)', 'C_profil::DeleteProfil/$1');
$routes->post('EditProfil', 'C_profil::EditProfil');

//profil Avec JSON
// $routes->get('profil', 'C_profil::AfficherProfilJson');
// $routes->get('profil/(:num)', 'C_profil::AfficherProfilByIdJson/$1');
// $routes->post('profil', 'C_profil::AjoutProfilJson');
// $routes->put('profil/(:num)', 'C_profil::EditProfilJson/$1');
// $routes->get('profil/(:num)', 'C_profil::DeleteProfilJson/$1');

//menu
$routes->get('menu', 'C_menu::AfficherMenu');
$routes->post('AjoutMenu', 'C_menu::AjoutMenu');
$routes->get('DeleteMenu/(:num)', 'C_menu::DeleteMenu/$1');
$routes->post('EditMenu', 'C_menu::EditMenu');

//menu Avec JSON
// $routes->get('menu', 'C_menu::AfficherMenuJson');
// $routes->get('menu/(:num)', 'C_menu::AfficherMenuByIdJson/$1');
// $routes->post('menu', 'C_menu::AjoutMenuJson');
// $routes->put('menu/(:num)', 'C_menu::EditMenuJson/$1');
// $routes->get('menu/(:num)', 'C_menu::DeleteMenuJson/$1');

//sous_menu
$routes->get('sous_menu', 'C_sousMenu::AfficherSous_menu');
$routes->post('AjoutSous_menu', 'C_sousMenu::AjoutSous_menu');
$routes->get('DeleteSous_menu/(:num)', 'C_sousMenu::DeleteSous_menu/$1');
$routes->post('EditSous_menu', 'C_sousMenu::EditSous_menu');

//Sous_menu avec JSON
// $routes->get('sous-menu', 'C_sousMenu::AfficherSousMenuJson');
// $routes->get('sous-menu/(:num)', 'C_sousMenu::AfficherSousMenuByIdJson/$1');
// $routes->post('sous-menu', 'C_sousMenu::AjoutSousMenuJson');
// $routes->put('sous-menu/(:num)', 'C_sousMenu::EditSousMenuJson/$1');
// $routes->get('sous-menu/(:num)', 'C_sousMenu::DeleteSousMenuJson/$1');

//role
$routes->post('SaveRole', 'C_role::SaveRole');
$routes->get('getRoles/(:num)', 'C_role::getRolesByProfile/$1');