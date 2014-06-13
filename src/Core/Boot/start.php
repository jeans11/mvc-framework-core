<?php

use Core\Config\Config;
use Core\Bracket\LoadAliasClass;

/**
 * Ajout de la config au container
 */
$app->addInstance('config', new Config($app['path.config'], $app['path.psr0']));

/**
 * Charge les bundles
 */
$config = $app['config'];

$config['bundle'];

/**
 * Ajoute certains services au container
 */
$app->addToClassNames($config['alias']);

/**
 * Résout les dépendances
 */
$app->solvesDependencies($config['providers']);

/**
 * Charge les alias de classes
 */
LoadAliasClass::getInstance($config['alias'])->check();

/**
 * Router
 */
$router = $app['router'];

/**
 * Enregistre les routes
 */
$router->setRoutes($config['routes']);

/**
 * Enregistre le router de l'application 
 */
$app->setRouter($router);
