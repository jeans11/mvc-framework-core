<?php
namespace Core\Application;

use Core\Container\Container;

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
	public function addToClassNames($alias)
	{
		$classes = array(
			'Core\Application\Application' => array(
				'aliasProvider' => 'app'
			)
		);

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
	public function solvesDependencies($providers)
	{
		$services = $this->parseJson(__DIR__.'/../Config/providers.json');
		if (is_array($providers)) {
			$services = array_merge($services, $providers);
		}
		$this->register($services);
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

}
