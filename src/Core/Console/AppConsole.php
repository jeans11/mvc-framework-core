<?php
namespace Core\Console;

class AppConsole
{
	private static $commands = array(
		'create:bundle' => 'CreateBundle'
	);

	public function run()
	{
		$options = Args::getOptions();

	}
}
