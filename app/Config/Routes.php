<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UserController::index');
$routes->get('/dashboard', 'Dashboard::index');
// $routes->get('/login', 'UserController::index');
$routes->post('/authenticate', 'UserController::authenticate');
$routes->get('/logout', 'UserController::logout');

//Usermgmt
$routes->get('/user', 'UserController::user');
$routes->get('/adduser', 'UserController::adduser');
