<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/*
 * --------------------------------------------------------------------
 * Route Definitons
 * --------------------------------------------------------------------
*/

// Frontend
$routes->get('/', 'Home::index');

/* Backend : Start */

// Dashboard
$routes->get('/dashboard', 'Dashboard::index');

// Users
$routes->get('/dashboard/users/create', 'User::create');
$routes->get('/dashboard/users/edit/(:any)', 'User::edit/$1');
$routes->get('/dashboard/users/(:any)', 'User::show/$1');
$routes->get('/dashboard/users', 'User::index');
$routes->post('/dashboard/users/delete/(:any)', 'User::delete/$1');
$routes->post('/dashboard/users/update/(:any)', 'User::update/$1');
$routes->post('/dashboard/users/store', 'User::store');

// Wilayah
$routes->get('/dashboard/wilayah', 'Wilayah::index');
$routes->get('/dashboard/wilayah/create', 'Wilayah::create');
$routes->post('/dashboard/wilayah/store', 'Wilayah::store');
$routes->get('/dashboard/wilayah/edit/(:any)', 'Wilayah::edit/$1');
$routes->post('/dashboard/wilayah/update/(:any)', 'Wilayah::update/$1');
$routes->post('/dashboard/wilayah/delete/(:any)', 'Wilayah::delete/$1');

// Settings
$routes->get('/dashboard/setting', 'Setting::index');
$routes->post('/dashboard/setting/update/(:any)', 'Setting::update/$1');

// Jenis KOS
$routes->get('/dashboard/jeniskos', 'JenisKos::index');
$routes->post('/dashboard/jeniskos/update/(:any)', 'JenisKos::update/$1');

// Kos
$routes->get('/dashboard/kos/verification/(:any)', 'Kos::verification/$1');
$routes->get('/dashboard/kos/edit/(:any)', 'Kos::edit/$1');
$routes->get('/dashboard/kos/(:any)', 'Kos::show/$1');
$routes->get('/dashboard/kos', 'Kos::index');
$routes->get('/dashboard/kos/create', 'Kos::create');
$routes->post('/dashboard/kos/store', 'Kos::store');
$routes->post('/dashboard/kos/update/(:any)', 'Kos::update/$1');
$routes->post('/dashboard/kos/delete/(:any)', 'Kos::delete/$1');

/* Backend : End */


// Auth
$routes->get('/login', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->get('/logout', 'Auth::logout');
