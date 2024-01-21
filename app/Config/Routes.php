<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UserController::index');
$routes->get('/profile', 'UserController::profile');
$routes->get('/profile/saved', 'UserController::saved');
$routes->get('/create', 'UserController::create');
$routes->get('/post/(:num)', 'UserController::post/$1');

$routes->post('/upload', 'PostController::upload');

$routes->post('/tmp-image/create', 'TemporaryController::create');
$routes->post('/tmp-upload', 'UserController::tmpUpload');
$routes->delete('/tmp-delete', 'UserController::tmpDelete');