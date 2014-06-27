<?php

use Core\Bracket\LoadAliasClass;
use Core\Routing\Router;
use Core\Facades\Facade;

/**
 * Ajoute l'instance de l'application
 * pour les facades
 */
Facade::setInstanceApp($app);

/**
 * Ajout de certaines classe au container
 */
require __DIR__.'/../Config/addInstance.php';

/**
 * Attrape les exceptions qui ne sont pas
 * attrapée
 */
$app['handlerException']->setExceptionHandler();

/**
 * Charge les bundles
 */
$config = $app['config'];

$config['bundle'];

/* 
 * Ajoute les alias des classes
 */
$app->addToClassNames($config['alias']);

/**
 * Charge les alias de classes
 */
LoadAliasClass::getInstance($config['alias'])->check();

/**
 * Router
 */
$router = new Router($config['routes']);

/**
 * Enregistre le router de l'application 
 */
$app->addInstance('router', $router);

/**
 * Résout les dépendances
 */
$app->solvesDependencies($config['providers']);

