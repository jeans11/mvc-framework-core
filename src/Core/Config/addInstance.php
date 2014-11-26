<?php

use Core\Http\HttpRequest;
use Core\Http\HttpResponse;
use Core\Http\Redirection;
use Core\Config\Config;
use Core\Exception\HandlerException;
use \Twig_Loader_Filesystem;
use \Twig_Environment;
use Core\View\View;
use Core\Console\AppConsole;
use Core\Console\Args;
use Core\Config\Environment;
use Core\Bracket\Twig\UrlCreator;

$app->addInstance('config', new Config($app['path.config'], $app['path.psr0']))
	->addInstance('request', new HttpRequest())
	->addInstance('httpResponse', new HttpResponse())
	->addInstance('twigFilesystem', new Twig_Loader_Filesystem(
		array(
			$app['path.psr0'],
			$app['path.framework']
		)
	))
	->addInstance('twigEnvironment', new Twig_Environment($app['twigFilesystem']))
	->addInstance('view', new View($app['twigEnvironment']))
	->addInstance('handlerException', new HandlerException($app['httpResponse']))
	->addInstance('appConsole', new AppConsole())
	->addInstance('args', new Args())
	->addInstance('env', new Environment())
	->addInstance('twig.url', new UrlCreator())
	->addInstance('redirection', new Redirection($app['request']));

