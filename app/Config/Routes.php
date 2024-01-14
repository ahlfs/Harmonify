<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\TemporaryController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UserController::index');
$routes->get('/profile', 'UserController::profile');
$routes->get('/profile/saved', 'UserController::saved');
$routes->get('/create', 'UserController::create');
$routes->get('/post', 'UserController::post');

$routes->post('/upload', 'PostController::upload');

$routes->get('/tmp-image/create', 'TemporaryController::create');
$routes->post('/tmp-upload', 'UserController::tmpUpload');
$routes->delete('/tmp-delete', 'UserController::tmpDelete');