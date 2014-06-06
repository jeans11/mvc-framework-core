<?php

use Core\Config\Config;

/**
 * Ajout de la config au container
 */
$app->addInstance('config', new Config($app['path.config'], $app['path.psr0']));

/**
 * Charge les bundles
 */
$config = $app['config']->get('bundle');

/**
 * Ajoute certains services au container
 */
$app->addToClassNames();

/**
 * Résout les dépendances
 */
$app->solvesDependencies();



