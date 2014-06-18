<?php
namespace Core\Bracket\RegEx;

class RegExFactory
{
	public static function get($type)
	{
		$className = 'RegExp'.ucfirst($type);
		return new $className;
	}
}
