<?php
namespace Core\Application;

use Core\Container\Container;
use Core\Routing\Router;
use Core\Routing\RouteMatcher;
use Core\Http\HttpRequest;
use Core\Controller\ResolverController;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use SplSubject;
use SplObserver;

class Application extends Container implements SplSubject
{
	/**
	 * Appel de certains traits
	 */
	use \Core\Bracket\Traits\ParseJsonTrait;

	/**
	 * Observers
	 *
	 * @var array
	 */
	private static $observers = array();

	/**
	 * Environnement de lancement
	 *
	 * @var string
	 */
	private static $env;

	/**
	 * Ajoute les services au container 
	 * 
	 * @param array $alias
	 * @return void
	 */
	public function addToClassNames($alias = array())
	{
		$classes = $this->parseJson(__DIR__.'/../Config/alias.json');

		foreach (array_merge($classes, $alias) as $key => $value) {
			$this->classNames[$value['aliasProvider']] = $key;
		}
	}

	/**
	 * Ajoute les chemin au container
	 *
	 * @return void
	 */
	public function installPath(array $paths)
	{
		foreach	($paths as $key => $path) {
			$this->contains['path.'.$key] = realpath($path);
		}
	}

	/**
	 * Résout les dépendances
	 *
	 * @return void
	 */
	public function solvesDependencies($providers = array())
	{
		$this->register(array_merge($this->parseJson(__DIR__.'/../Config/providers.json'), $providers));
	}

	/**
	 * Ajoute une instance au container
	 *
	 * @param string $key
	 * @param mixed $instance
	 * @return Core\Application\Application
	 */
	public function addInstance($key, $instance)
	{
		$this[$key] = $instance;
		return $this;
	}

	/**
	 * Démarre l'application
	 */
	public function run()
	{
		$this->setEnv('http');

		$response = $this['httpResponse'];

		$response
			->setResolverController($this['resolveController'])
			->send();
	}

	public function runConsole()
	{
		$this->setEnv('console');

		$this['appConsole']->run();
	}

	/**
	 * Configuration de Doctrine
	 *
	 * @return Doctrine\ORM\EntityManager
	 */
	public function setupDoctrine()
	{
		$setup = Setup::createAnnotationMetadataConfiguration(array($this['path.app']), false);

		$database = $this['config']['database'];

		$defaultDriver = $database['default'];

		return EntityManager::create(
			$database['connections'][$defaultDriver],
			$setup
		);
	}

	/**
	 * Ajoute un observateur
	 *
	 * @param SplObserver $observer
	 * @return void
	 */
	public function attach(SplObserver $observer)
	{
		static::$observers[] = $observer;
	}

	/**
	 * Supprime un observateur
	 * @param SplObserver $observer
	 * @return void
	 */
	public function detach(SplObserver $observer)
	{
		unset(static::$observer[$observer]);
	}

	/**
	 * Notifie les observateurs
	 *
	 * @return void
	 */
	public function notify()
	{
		foreach (static::$observers as $observer) {
			$observer->update($this);
		}
	}

	/**
	 * Modifie l'environnement
	 *
	 * @param string $value
	 * @return void
	 */
	public function setEnv($value)
	{
		static::$env = $value;	
		$this->notify();
	}

	/**
	 * Retourne l'environnement
	 * courant
	 *
	 * @return string
	 */
	public function getEnv()
	{
		return static::$env;	
	}

}

