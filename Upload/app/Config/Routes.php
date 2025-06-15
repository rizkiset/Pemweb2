<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/books', 'Books::index');
$routes->get('/books/create', 'Books::create');
$routes->post('/books/save', 'Books::save'); // Ini sudah benar

$routes->get('/books/edit/(:segment)', 'Books::edit/$1'); // Ini sudah benar
$routes->post('/books/update/(:num)', 'Books::update/$1'); // Ini sudah benar
$routes->delete('/books/(:num)', 'Books::delete/$1');

$routes->get('/books/(:segment)', 'Books::detail/$1');

$routes->get('/about', 'Pages::about');
$routes->get('/contact', 'Pages::contact');

// HAPUS DUA BARIS DUPLIKAT DI BAWAH INI
// $routes->get('/books/edit/(:segment)', 'Books::edit/$1');
// $routes->post('/books/update/(:num)', 'Books::update/$1');