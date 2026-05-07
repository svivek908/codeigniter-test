<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Auth::login');

$routes->match(['get','post'], 'login', 'Auth::login');
$routes->match(['get','post'], 'register', 'Auth::register');

$routes->get('logout', 'Auth::logout');

$routes->group('', ['filter'=>'auth'], function($routes){

    $routes->get('dashboard', 'TaskController::index');

    $routes->get('api/tasks', 'TaskController::getTasks');

    $routes->post('task/store', 'TaskController::store');
    $routes->get('task/edit/(:num)', 'TaskController::edit/$1');
    $routes->post('task/update/(:num)', 'TaskController::update/$1');
    $routes->post('task/delete/(:num)', 'TaskController::delete/$1');
});