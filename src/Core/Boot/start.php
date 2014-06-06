<?php

use Core\Config\Config;

/**
 * Ajout de la config au container
 */
$app->addInstance('config', new Config($app['path.config'], $app['path.psr0']));

$config = $app['config'];

/**
 * Charge les bundles
 */
$config['bundle'];

/**
 * Ajoute certains services au container
 */
$app->addToClassNames();

/**
 * Résout les dépendances
 */
$app->solvesDependencies();



