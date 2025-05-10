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
$routes->get('/users', 'User::index');

/* Backend : End */


// Auth
$routes->get('/login', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->get('/logout', 'Auth::logout');
