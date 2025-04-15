<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/About', 'Page::Aboute');
$routes->get('/Contact', 'Page::Contact');
$routes->get('/Faqs', 'Page::Faqs');
$routes->get('/tols', 'Page::tols');
$routes->get('/bio', 'Page::bio');

$routes->setAutoRoute(false);

