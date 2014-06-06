<?php

use Core\Config\Config;

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
$app->solvesDependencies();



