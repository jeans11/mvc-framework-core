<?php
namespace Core\Application;

use Core\Container\Container;
use Core\Routing\Router;
use Core\Routing\RouteMatcher;
use Core\Http\HttpRequest;
use Core\Controller\ResolverController;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Application extends Container
{
	/**
	 * Appel de certains traits
	 */
	use \Core\Bracket\Traits\ParseJsonTrait;

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
		$response = $this['httpResponse'];

		$response
			->setResolverController($this['resolveController'])
			->send();
	}

	public function runConsole()
	{
		$this['appConsole']->run();
	}

	/**
	 * Configuration de Doctrine
	 *
	 * @return Doctrine\ORM\EntityManager
	 */
	public function setupDoctrine()
	{
		$setup = Setup::createAnnotationMetadataConfiguration(array($this['path.psr0']), false);

		$database = $this['config']['database'];

		$defaultDriver = $database['default'];

		return EntityManager::create(
			$database['connections'][$defaultDriver],
			$setup
		);
	}

	/**
	 * Ajoute certains services à Twig
	 *
	 * @return void
	 */
	public function addToTwig()
	{
		foreach ($this->contains as $key => $value) {
			if (preg_match('/twig\./', $key)) {
				$key = explode('.',$key);
				$this['twigEnvironment']->addGlobal($key[1], $value);
			}
		}
	}

	/**
	 * Retourne la valeur en fonction
	 * de la clé
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function get($key)
	{
		return $this->make($key);
	}

}

