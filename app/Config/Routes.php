<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UserController::index');
$routes->get('/profile/(:num)', 'UserController::profile/$1');
$routes->get('/profile/(:num)/liked', 'UserController::liked/$1');
$routes->get('/profile/(:num)/album', 'UserController::album/$1');
$routes->get('/create', 'UserController::create');
$routes->get('/post/(:num)', 'UserController::post/$1');

$routes->post('/upload', 'PostController::upload');
$routes->get('/download/(:num)', 'PostController::download/$1');
$routes->post('/komentar/(:num)', 'PostController::komentar/$1');

$routes->post('/register', 'AuthController::valid_register');
$routes->post('/login', 'AuthController::valid_login');
$routes->get('/logout', 'AuthController::logout');

