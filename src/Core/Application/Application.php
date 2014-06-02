<?php
namespace Core\Application;

use Core\Container\Container;

class Application extends Container
{
	/**
	 * Ajoute les services au container 
	 * 
	 * @return void
	 */
	public function addToClassNames()
	{
		$classes = array(
			'app' => 'Core\Application\Application',
			'config' => 'Core\Config\Config'
		);

		foreach ($classes as $key => $value) {
			$this->classNames[$key] = $value;
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

	public function solvesDependencies()
	{
		if (file_exists($this['path.config'].'/providers.json'))	{
				
		}

		$this->register(json_decode(file_get_contents(__DIR__.'/../Config/providers.json'), true));
	}

}
