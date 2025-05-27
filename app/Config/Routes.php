<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('accueil', 'Visiteur::pageDAccueil');
$routes->match(['get', 'post'], 'creermoncompte', 'Visiteur::senregistrer');
$routes->get('liaisonsparsecteur', 'Visiteur::liaisonsParSecteur');
$routes->get('tarifsduneliaison/(:alphanum)', 'Visiteur::tarifsDUneLiaison/$1');
$routes->get('horairesdetraversee/(:alphanum)', 'Visiteur::voirLesHoraires/$1');
$routes->get('horairesdetraversee', 'Visiteur::voirLesHoraires');
$routes->match(['get', 'post'], 'meconnecter', 'Visiteur::seconnecter');
$routes->match(['get', 'post'], 'modifiermoncompte', 'Client::modifcompte', ["filter"=> "filtresuper"]);
$routes->get("deconnexion", 'Client::seDeconnecter', ["filter"=>"filtresuper"]);

/*
$routes->group("client", ["filter"=>"fitresuper"], function($routes){
    
    
});*/