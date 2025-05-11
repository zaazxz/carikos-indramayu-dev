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
$routes->get('/dashboard/users/edit/(:any)', 'User::edit/$1');
$routes->get('/dashboard/users/(:any)', 'User::show/$1');
$routes->get('/dashboard/users/create', 'User::create');
$routes->get('/dashboard/users', 'User::index');
$routes->post('/dashboard/users/delete/(:any)', 'User::delete/$1');
$routes->post('/dashboard/users/update/(:any)', 'User::update/$1');
$routes->post('/dashboard/users/store', 'User::store');

// Settings
$routes->get('/dashboard/setting', 'Setting::index');


/* Backend : End */


// Auth
$routes->get('/login', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->get('/logout', 'Auth::logout');
