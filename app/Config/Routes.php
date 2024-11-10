<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/tender/create', 'TenderController::create');
$routes->post('/tender/store', 'TenderController::store');
$routes->get('/tender/list_contractor', 'TenderController::listContractor');
$routes->get('/tender/list_supplier', 'TenderController::listSupplier');
$routes->get('/login', 'UserController::login');
$routes->post('/login', 'UserController::authenticate');
$routes->get('/logout', 'UserController::logout');

