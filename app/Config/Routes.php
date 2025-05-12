<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('accueil', 'Visiteur::pageDAccueil');
$routes->match(['get', 'post'], 'creermoncompte', 'Visiteur::senregistrer');
