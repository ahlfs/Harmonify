<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UserController::index');
$routes->get('/profile', 'UserController::profile');
$routes->get('/profile/saved', 'UserController::saved');
$routes->get('/create', 'UserController::create');
$routes->get('/post', 'UserController::post');