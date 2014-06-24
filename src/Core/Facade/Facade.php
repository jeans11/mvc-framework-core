<?php
namespace Core\Facade;

use Core\Application\Application;

abstract class Facade
{
	/**
	 * Instance de l'application
	 *
	 * @var Core\Application\Application
	 */
	protected static $app;	

	/**
	 * Retourne le nom du providers
	 * à instancier
	 *
	 * @return string
	 */
	abstract public static function getProviders()

	/**
	 * Modifie l'instance de l'application
	 *
	 * @param Core\Application\Application
	 * @return void
	 */
	public static function setInstanceApp(Application $app)
	{
		static::$app = $app;	
	}

	protected static function __callStatic($action, $args)
	{
		echo $action;	
	}
}
