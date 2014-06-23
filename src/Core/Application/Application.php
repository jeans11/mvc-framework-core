<?php
namespace Core\Application;

use Core\Container\Container;
use Core\Routing\Router;
use Core\Routing\RouteMatcher;
use Core\Http\HttpRequest;
use Core\Controller\ResolverController;

class Application extends Container
{
	/**
	 * Appel de certains traits
	 */
	use \Core\Bracket\Traits\ParseJsonTrait;

	/**
	 * Instance du router
	 *
	 * @var Core\Routing\Router
	 */
	private $router;

	/**
	 * Ajoute les services au container 
	 * 
	 * @param array $alias
	 * @return void
	 */
	public function addToClassNames($alias = array())
	{
		/*$classes = array(
			'Core\Application\Application' => array(
				'aliasProvider' => 'app'
			),
			'Core\Http\HttpRequest' => array(
				'aliasProvider'	=> 'httpRequest'
			),
			'Core\Routing\Router' => array(
				'aliasProvider'	=> 'router'
			)
		);
*/
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
	 */
	public function addInstance($key, $instance)
	{
		$this[$key] = $instance;
	}

	/**
	 * Démarre l'application
	 */
	public function run()
	{
		$response = $this['httpResponse'];

		$response->send();
	}
}

