<?php
namespace Core\Console;

class Args
{
	public static function getOptions()
	{
		$args = array_slice($this->getArgv(), 1);	

		if (!empty($args)) {
			return $args;		
		}

		throw new ConsoleException(ConsoleException::MISSING_ARG);
	}

	public function getArgv()
	{
		return $_SERVER['argv'];
	}
}
