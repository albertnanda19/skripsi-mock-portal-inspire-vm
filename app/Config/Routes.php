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

// Menambahkan routing group dengan JWTMiddleware
$routes->group('api/v1', ['filter' => 'jwt'], function($routes) {
    // Tambahkan rute yang memerlukan autentikasi di sini
    $routes->get('users/students', 'StudentController::students'); 
    $routes->get('secure', 'SecureController::index');
});