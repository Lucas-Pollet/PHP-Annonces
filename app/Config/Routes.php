<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('connexion', 'connexion::index');
$routes->get('inscription', 'inscription::index');
$routes->post('connexion', 'connexion::index');
$routes->post('inscription', 'inscription::index');

$routes->get('page', 'Ad::page');
$routes->get('logout', 'Logout::index');
$routes->get('account', 'account::index');

$routes->get('account/messages', 'account::messages');
$routes->get('messages/conv/(:num)/(:any)', 'Messages::conv/$1/$2');
$routes->get('messages/conv', 'Messages::conv');
$routes->post('messages/conv', 'Messages::conv');

$routes->get('account/myad', 'account::myad');
$routes->get('account/modifnom', 'account::modifnom');
$routes->get('account/modifpseudo', 'account::modifpseudo');
$routes->get('account/modifpwd', 'account::modifpwd');
$routes->get('account/delaccount', 'account::delaccount');

$routes->get('account/recupmdp', 'account::recupmdp');
$routes->post('account/recupmdp', 'account::recupmdp');

$routes->get('account/testtoken', 'account::testtoken');
$routes->post('account/testtoken', 'account::testtoken');

$routes->get('account/modifpwdwithtoken', 'account::modifpwdwithtoken');
$routes->post('account/modifpwdwithtoken', 'account::modifpwdwithtoken');

$routes->post('account/modifnom', 'account::modifnom');
$routes->post('account/modifpseudo', 'account::modifpseudo');
$routes->post('account/modifpwd', 'account::modifpwd');
$routes->post('account/delaccount', 'account::delaccount');

$routes->get('admin', 'Admin::index');
$routes->get('admin/listeuti', 'Admin::listeuti');
$routes->get('admin/listead', 'Admin::listead');
$routes->get('admin/blockad/(:any)', 'Admin::blockad/$1');
$routes->get('admin/delaccount/(:any)', 'Admin::delaccount/$1');
$routes->get('admin/editprofil/(:any)', 'Admin::editprofil/$1');
$routes->post('admin/editprofil/', 'Admin::editprofil');

$routes->get('admin/sendmail/(:any)', 'Admin::sendmail/$1');
$routes->post('admin/sendmail/', 'Admin::sendmail');

$routes->get('account/modifpwd', 'account::modifpwd');

// Action ad
$routes->get('ad/create', 'Ad::create');
$routes->get('ad/edit/(:num)', 'Ad::edit/$1');

$routes->post('ad/create', 'Ad::create');
$routes->post('ad/edit', 'Ad::edit');

$routes->get('ad/archive/(:num)', 'Ad::archive/$1');
$routes->get('ad/delete/(:num)', 'Ad::delete/$1');


$routes->get('ad/show/(:num)', 'Ad::show/$1');


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
