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
$routes->post('/updatepost/(:num)', 'PostController::updatepost/$1');

$routes->get('/editprofile/(:num)', 'UserController::editprofile/$1');
$routes->post('/updateprofile/(:num)', 'UserController::updateprofile/$1');

$routes->get('/addalbum', 'UserController::addalbum');
$routes->post('/submitalbum', 'UserController::submitalbum');
$routes->get('/profile/album/(:num)', 'UserController::viewalbum/$1');


$routes->post('/search', 'UserController::search');
$routes->get('/accessdenied', 'UserController::accessdenied');

$routes->get('/editpost/(:num)', 'PostController::editpost/$1');
$routes->get('/deletepost/(:num)', 'PostController::deletepost/$1');

$routes->post('/upload', 'PostController::upload');
$routes->get('/download/(:num)', 'PostController::download/$1');
$routes->post('/komentar/(:num)', 'PostController::komentar/$1');
$routes->get('/like/(:num)', 'PostController::like/$1');
$routes->get('/unlike/(:num)', 'PostController::unlike/$1');

$routes->post('/register', 'AuthController::valid_register');
$routes->post('/login', 'AuthController::valid_login');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/verifyEmail/(:any)/(:any)', 'AuthController::verifyEmail/$1/$2');
$routes->get('/forgotpassword', 'AuthController::forgotpassword');
$routes->post('/changepassword/(:num)', 'AuthController::changepassword/$1');




