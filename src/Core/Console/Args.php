<?php
namespace Core\Console;

class Args
{
	public static function getOptions()
	{
		$args = array_slice(self::getArgv(), 1);	

		if (!empty($args)) {
			return $args;		
		}

		throw new ConsoleException(ConsoleException::MISSING_ARG);
	}

	public function getArgv()
	{
		return array_key_exists('argv',$_SERVER) ? $_SERVER['argv'] : array();
	}
}
