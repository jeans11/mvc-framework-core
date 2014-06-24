<?php
namespace Core\Facades;

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
	abstract public static function getProviders();

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

	/**
	 * Appel une méthode qui n'existe pas
	 * statiquement
	 *
	 * @param string $action
	 * @param mixed $args
	 * @return mixed
	 */
	protected static function __callStatic($action, $args)
	{
		$object = self::getInstanceOf(static::getProviders());
		echo $args;
	}

	/**
	 * Récupère l'instance du providers
	 * souhaité
	 *
	 * @param string $name
	 * @return mixed
	 */
	protected static function getInstanceOf($name)
	{
		return self::$app[$name];
	}
}
