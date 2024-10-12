<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api/v1', function($routes) {
    $routes->get('test', 'Home::test');
    $routes->post('login', 'AuthController::login');
});

$routes->group('api/v1', ['filter' => 'jwt'], function($routes) {
    $routes->get('users/students', 'UserController::students'); 
    $routes->get('secure', 'SecureController::index');
});