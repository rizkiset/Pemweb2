<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MataKuliah::index');
$routes->get('/mata_kuliah/details/(:segment)', 'MataKuliah::details/$1');

