<?php
namespace Core\Console;

class AppConsole
{
	private static $commands = array(
		'create:bundle' => '\Core\Console\Commands\CreateBundle'
	);

	public static function run()
	{
		$options = Args::getOptions();

		$object = $this->getCommandInstance($options);
	}

	private function getCommandInstance($options)
	{
		if (isset(static::$commands[$options[1]])) {
			return new static::$commands[$options[1]];
		}

		echo 'eh non';
	}
}
