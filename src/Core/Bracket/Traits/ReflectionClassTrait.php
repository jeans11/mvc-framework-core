<?php
namespace Core\Bracket\Traits;

use ReflectionClass;

trait ReflectionClassTrait
{
	/**
	 * Parse un fichier json et 
	 * retourne un tableau PHP
	 *
	 * @param string $json
	 * @return array
	 */
	public function getReflectionClass($className)
	{
		return new ReflectionClass($className);
	}
}
