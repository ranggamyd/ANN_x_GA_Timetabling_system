<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Dashboard');
$routes->get('auth', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');
$routes->get('profile', 'Auth::profile');
$routes->get('profile/update', 'Auth::update');

$routes->group('mata_kuliah', function ($routes) {
    $routes->get('', 'MataKuliah::index');
    $routes->get('create', 'MataKuliah::create');
    $routes->post('store', 'MataKuliah::store');
    $routes->get('edit/(:num)', 'MataKuliah::edit/$1');
    $routes->put('update/(:num)', 'MataKuliah::update/$1');
    $routes->delete('delete/(:num)', 'MataKuliah::delete/$1');
    $routes->get('setAllActive', 'MataKuliah::setAllActive');
    $routes->get('setAllITActive', 'MataKuliah::setAllITActive');
});
$routes->group('jadwal_dosen', function ($routes) {
    $routes->get('', 'JadwalDosen::index');
    $routes->get('create', 'JadwalDosen::create');
    $routes->post('store', 'JadwalDosen::store');
    $routes->get('edit/(:num)', 'JadwalDosen::edit/$1');
    $routes->put('update/(:num)', 'JadwalDosen::update/$1');
    $routes->delete('delete/(:num)', 'JadwalDosen::delete/$1');
});

/*
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
