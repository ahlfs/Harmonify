<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Primary
$routes->get('/', 'UserController::index');

$routes->post('/search', 'UserController::search');

$routes->get('/accessdenied', 'UserController::accessdenied');

// Auth
$routes->post('/register', 'AuthController::valid_register');

$routes->post('/login', 'AuthController::valid_login');

$routes->get('/logout', 'AuthController::logout');

$routes->get('/changepassword', 'UserController::changepassword');

$routes->post('/changepasswordsubmit/(:num)', 'UserController::changepasswordsubmit/$1');

// Profile
$routes->get('/profile/(:num)', 'UserController::profile/$1');

$routes->get('/profile/(:num)/liked', 'UserController::liked/$1');

$routes->get('/profile/(:num)/album', 'UserController::album/$1');

$routes->get('/editprofile/(:num)', 'UserController::editprofile/$1');

$routes->post('/updateprofile/(:num)', 'UserController::updateprofile/$1');

// Post
$routes->get('/create', 'UserController::create');

$routes->post('/upload', 'PostController::upload');

$routes->get('/post/(:num)', 'UserController::post/$1');

$routes->get('/download/(:num)', 'PostController::download/$1');

$routes->get('/editpost/(:num)', 'PostController::editpost/$1');

$routes->post('/updatepost/(:num)', 'PostController::updatepost/$1');

$routes->get('/deletepost/(:num)', 'PostController::deletepost/$1');

// Like & Comment
$routes->post('/komentar/(:num)', 'PostController::komentar/$1');

$routes->get('/deletecomment/(:num)/(:num)', 'PostController::deletekomentar/$1/$2');

$routes->get('/like/(:num)', 'PostController::like/$1');

$routes->get('/unlike/(:num)', 'PostController::unlike/$1');

// Album
$routes->get('/addposttoalbum/(:num)/(:num)', 'PostController::addposttoalbum/$1/$2');

$routes->get('/addalbum', 'UserController::addalbum');

$routes->get('/submitalbum/(:any)', 'UserController::submitalbum/$1');

$routes->get('/profile/album/(:num)', 'UserController::viewalbum/$1');

$routes->get('/deletealbum/(:num)', 'UserController::deletealbum/$1');

$routes->get('/editalbum/(:num)/(:any)', 'UserController::editalbum/$1/$2');

$routes->get('/removefromalbum/(:num)/(:num)', 'UserController::removefromalbum/$1/$2');

// Email Verification
$routes->get('/verify/email/(:any)/(:any)', 'AuthController::verifyEmail/$1/$2');

$routes->get('/verify/resetpassword/(:any)/(:any)', 'AuthController::verifyResetPassword/$1/$2');

$routes->post('/forgotpassword', 'AuthController::forgotpassword');

$routes->post('/resetpassword/(:num)', 'AuthController::resetpassword/$1');

$routes->get('/changeemail', 'UserController::changeemail');

$routes->post('/changeemailsubmit/(:num)', 'UserController::changeemailsubmit/$1');

$routes->get('/verify/changeemail/(:any)/(:any)', 'UserController::verifyChangeEmail/$1/$2');

// Other
$routes->get('/deleteacc/(:num)', 'UserController::deleteaccount/$1');

$routes->get('/testo', 'AuthController::testo');

