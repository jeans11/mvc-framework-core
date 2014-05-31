<?php

namespace Core\Application;

use Container;

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
			'app' => 'Core\Application\Application'
		);

		foreach ($services as $key => $value) {
			$this->contains[$key] = $value;
		}
	}

}
