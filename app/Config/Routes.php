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
$routes->group('', ['filter' => 'level:Admin, Pemilik Kos, Pencari Kos'], function ($routes) {

    // Dashboard
    $routes->get('/dashboard', 'Dashboard::index');

    // Users
    $routes->get('/dashboard/users/create', 'User::create');
    $routes->get('/dashboard/users/edit/(:num)', 'User::edit/$1');
    $routes->get('/dashboard/users/(:num)', 'User::show/$1');
    $routes->get('/dashboard/users', 'User::index');
    $routes->get('/dashboard/users/verification/(:num)', 'User::verification/$1');
    $routes->post('/dashboard/users/delete/(:num)', 'User::delete/$1');
    $routes->post('/dashboard/users/update/(:num)', 'User::update/$1');
    $routes->post('/dashboard/users/store', 'User::store');

    // Wilayah
    $routes->get('/dashboard/wilayah', 'Wilayah::index');
    $routes->get('/dashboard/wilayah/create', 'Wilayah::create');
    $routes->post('/dashboard/wilayah/store', 'Wilayah::store');
    $routes->get('/dashboard/wilayah/edit/(:num)', 'Wilayah::edit/$1');
    $routes->post('/dashboard/wilayah/update/(:num)', 'Wilayah::update/$1');
    $routes->post('/dashboard/wilayah/delete/(:num)', 'Wilayah::delete/$1');

    // Settings
    $routes->get('/dashboard/setting', 'Setting::index');
    $routes->post('/dashboard/setting/update/(:num)', 'Setting::update/$1');

    // Jenis KOS
    $routes->get('/dashboard/jeniskos', 'JenisKos::index');
    $routes->post('/dashboard/jeniskos/update/(:num)', 'JenisKos::update/$1');

    // Kos
    $routes->get('/dashboard/kos/verification/(:num)', 'Kos::verification/$1');
    $routes->get('/dashboard/kos/edit/(:num)', 'Kos::edit/$1', ['filter' => 'level:Pemilik Kos']);
    $routes->get('/dashboard/kos/(:num)', 'Kos::show/$1');
    $routes->get('/dashboard/kos', 'Kos::index');
    $routes->get('/dashboard/kos/create', 'Kos::create');
    $routes->get('/dashboard/kos/delete/(:num)', 'Kos::delete/$1');
    $routes->post('/dashboard/kos/store', 'Kos::store');
    $routes->post('/dashboard/kos/update/(:num)', 'Kos::update/$1', ['filter' => 'level:Pemilik Kos']);

    // Customize
    $routes->get('/dashboard/profile/customize/(:num)', 'User::customize/$1');
    $routes->get('/dashboard/profile/changepassword/(:num)', 'User::changePassword/$1');
    $routes->post('/profile/update/(:num)', 'User::customizeUpdate/$1');
    $routes->post('/profile/changepassword/(:num)', 'User::changePasswordUpdate/$1');

    // Pemesanan
    $routes->get('/dashboard/pemesanan', 'Pemesanan::index');
    $routes->get('/pemesanan/create/(:num)', 'Pemesanan::create/$1', ['filter' => 'level:Pencari Kos']);
    $routes->get('/dashboard/pemesanan/detail/(:num)', 'Pemesanan::detail/$1');
    $routes->post('/pemesanan/store', 'Pemesanan::store', ['filter' => 'level:Pencari Kos']);
    $routes->get('/dashboard/pemesanan/approve/(:num)', 'Pemesanan::approve/$1');
    $routes->get('/dashboard/pemesanan/reject/(:num)', 'Pemesanan::reject/$1');
    $routes->get('/dashboard/pemesanan/delete/(:num)', 'Pemesanan::delete/$1');

});
/* Backend : End */


/* Auth : Start */

// Login
$routes->get('/login', 'Auth::login', ['filter' => 'level:guest']);
$routes->post('/login', 'Auth::checkLogin');

// Register
$routes->get('/register', 'Auth::register', ['filter' => 'level:guest']);
$routes->get('/register/pemilik', 'Auth::register', ['filter' => 'level:guest']);
$routes->post('/register', 'Auth::registerUser');

// Change Password
$routes->get('/change-password', 'Auth::changePassword', ['filter', 'level:guest']);
$routes->post('/change-password', 'Auth::changePasswordUpdate');

// Logout
$routes->get('/logout', 'Auth::logout', ['filter', 'level:Admin, Pemilik Kos, Pencari Kos']);

/* Auth : End */
