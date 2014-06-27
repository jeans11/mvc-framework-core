<?php

use Core\Http\HttpRequest;
use Core\Http\HttpResponse;
use Core\Config\Config;
use Core\Exception\HandlerException;
use \Twig_Loader_Filesystem;
use \Twig_Environment;
use Core\View\View;

$app->addInstance('config', new Config($app['path.config'], $app['path.psr0']));

$app->addInstance('request', new HttpRequest());

$app->addInstance('httpResponse', new HttpResponse());

$app->addInstance('twigFilesystem', new Twig_Loader_Filesystem(
	array(
		$app['path.psr0'],
		$app['path.petty']
	)
));

$app->addInstance('twigEnvironment', new Twig_Environment($app['twigFilesystem']));
 
$app->addInstance('view', new View($app['twigEnvironment']));

$app->addInstance('handlerException', new HandlerException($app['httpResponse']));

