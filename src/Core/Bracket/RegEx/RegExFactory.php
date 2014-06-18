<?php
namespace Core\Bracket\RegEx;

class RegExFactory
{
	/**
	 * Factory. Retourne la classe correspondante
	 * au type demandé
	 *
	 * @param string $type
	 * @return mixed
	 */
	public static function get($type)
	{
		$type = $type ?: 'default'; 
		$className = 'Core\Bracket\RegEx\RegEx'.ucfirst($type);
		return new $className;
	}
}
