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
	public function addToContains()
	{
		$services = array(
			'app' => 'Core\Application\Application',
			'toto' => 'test'
		);

		foreach ($services as $key => $value) {
			$this->contains[$key] = $value;
		}
	}

}
