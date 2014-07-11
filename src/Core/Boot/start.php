<?php

use Core\Bracket\LoadAliasClass;
use Core\Routing\Router;
use Core\Facades\Facade;
use Core\Manager\Manager;

/**
 * Démarre la session
 * Nécessaire pour l'utilisation
 * de la librairie PFBC
 */
session_start();

/**
 * Ajout de certaines classe au container
 */
require __DIR__.'/../Config/addInstance.php';

/**
 * On attache des observateurs sur l'environnement
 */
$app['env']->attach($app['handlerException']);

/**
 * Détection de l'environnement
 */
$app['env']->setEnv($app['args']->getArgv());

/**
 * Diffuse l'environnement de lancement
 */
$app['env']->spill();

/**
 * Ajoute l'instance de l'application
 * pour les facades
 *
 * @return void
 */
Facade::setInstanceApp($app);

/**
 * Ajoute l'instance de EntityManager
 * au Manager général
 */
Manager::setEntityManager($app->setupDoctrine());

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

/**
 * Ajout de l'application au container
 */
$app->addInstance('app', $app);
