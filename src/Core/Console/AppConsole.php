<?php
namespace Core\Console;

class AppConsole
{
	/**
	 * Tableau des commandes
	 *
	 * @var array
	 */
	private static $commands = array(
		'create:bundle' => '\Core\Console\Commands\CreateBundle'
	);

	/**
	 * Lancement de l'application console
	 *
	 * @return mixed
	 */
	public function run()
	{
		$options = Args::getOptions();

		$object = $this->getCommandInstance($options);

		$object->execute();
	}

	/**
	 * Retourne une instance de la commande
	 *
	 * @param array $options
	 * @return mixed
	 */
	private function getCommandInstance($options)
	{
		if (isset(static::$commands[$options[0]])) {
			return new static::$commands[$options[0]]($options);
		}

		throw new ConsoleException(ConsoleException::INVALID_ARG);
	}
}
