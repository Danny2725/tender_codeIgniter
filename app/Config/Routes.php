<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');


$routes->get('/api', 'Home::index');



// Auth 
$routes->post('auth/register', 'AuthController::register');
$routes->post('auth/login', 'AuthController::login');
$routes->get('auth/user', 'AuthController::getUserInfo');



// Tenders
$routes->post('tenders/create', 'TenderController::createTender');