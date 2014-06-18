<?php
namespace Core\Bracket\RegEx;

class RegExFactory
{
	public static function get($type)
	{
		$className = 'Core\Bracket\RegEx\RegEx'.ucfirst($type);
		return new $className;
	}
}
