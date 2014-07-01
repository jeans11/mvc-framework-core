<?php
namespace Core\Boot;

use Core\Application\Application;
use Core\Facades\Facade;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Booted
{
	/**
	 * Instance de l'application
	 *
	 * @var Core\Application\Application
	 */
	private $app;

	/**
	 * Singleton
	 *
	 * @var Core\Boot\Booted
	 */
	private static $instance;

	/**
	 * Crée une instance
	 *
	 * @param Core\Application\Application
	 * @return void
	 */
	public function __construct(Application $app)
	{
		$this->app = $app;	
	}

	/**
	 * Retourne l'unique instance
	 *
	 * @param Core\Application\Application;
	 * @return Core\Boot\Booted
	 */
	public static function getInstance(Application $app)
	{
		if (is_null(static::$instance)) {
			static::$instance = new self($app);
		}
		return static::$instance;
	}

	/**
	 * Ajoute l'instance de l'application
	 * pour les facades
	 *
	 * @return void
	 */
	public function registerAppFacade()
	{
		Facade::setInstanceApp($this->app);
	}

	/**
	 * Configuration de Doctrine
	 *
	 * @param array $database
	 * @return Doctrine\ORM\EntityManager
	 */
	public function setupDoctrine($database)
	{
		$setup = Setup::createAnnotationMetadataConfiguration(array($this->app['path.app']), false);

		$defaultDriver = $database['default'];

		return EntityManager::create(
			$database['connections'][$defaultDriver],
			$setup
		);
	}

}
