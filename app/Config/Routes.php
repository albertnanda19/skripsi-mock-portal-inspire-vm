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