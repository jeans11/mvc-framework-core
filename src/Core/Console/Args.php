<?php
namespace Core\Console;

class Args
{
	public static function getOptions()
	{
		$args = array_slice($_SERVER['argv'], 1);	

		if (!empty($args)) {
			return $args;		
		}

		throw new ConsoleException(ConsoleException::MISSING_ARG);
	}
}
