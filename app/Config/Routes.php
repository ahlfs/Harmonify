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
$routes->get('/submitalbum/(:any)', 'UserController::submitalbum/$1');
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

$routes->get('/testo', 'AuthController::testo');

$routes->get('/logout', 'AuthController::logout');

$routes->get('/addposttoalbum/(:num)/(:num)', 'PostController::addposttoalbum/$1/$2');

$routes->get('/verify/email/(:any)/(:any)', 'AuthController::verifyEmail/$1/$2');
$routes->get('/verify/resetpassword/(:any)/(:any)', 'AuthController::verifyResetPassword/$1/$2');
$routes->post('/forgotpassword', 'AuthController::forgotpassword');
$routes->post('/resetpassword/(:num)', 'AuthController::resetpassword/$1');

$routes->get('/changepassword', 'UserController::changepassword');
$routes->post('/changepasswordsubmit/(:num)', 'UserController::changepasswordsubmit/$1');

$routes->get('/changeemail', 'UserController::changeemail');
$routes->post('/changeemailsubmit/(:num)', 'UserController::changeemailsubmit/$1');
$routes->get('/verify/changeemail/(:any)/(:any)', 'UserController::verifyChangeEmail/$1/$2');

$routes->get('/deleteacc/(:num)', 'UserController::deleteaccount/$1');




