<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'TenderController::store', ['filter' => 'auth']);
$routes->get('/tender/create', 'TenderController::create', ['filter' => 'auth']);
$routes->post('/tender/createTender', 'TenderController::createTender', ['filter' => 'auth']);
$routes->get('/tender/list_contractor', 'TenderController::listContractor', ['filter' => 'auth']);
$routes->get('/tender/list_supplier', 'TenderController::listSupplier', ['filter' => 'auth']);

// Auth 
$routes->post('auth/register', 'AuthController::register');
$routes->get('/login', 'AuthController::index');
$routes->post('auth/login', 'AuthController::login');
$routes->get('auth/user', 'AuthController::getUserInfo', ['filter' => 'auth']);
$routes->get('/logout', 'UserController::logout', ['filter' => 'auth']);