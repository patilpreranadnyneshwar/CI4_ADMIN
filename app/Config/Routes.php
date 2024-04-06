<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->post('/login', 'Home::login');
$routes->get('/register', 'Home::register');
$routes->post('/register', 'Home::register');
$routes->match(['get','post'],'SigninController/loginAuth', 'SigninController::loginAuth');
$routes->get('/tables', 'Home::tables');
$routes->post('/tables', 'Home::tables'); // Corrected the typo here
