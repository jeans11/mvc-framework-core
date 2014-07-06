<?php
namespace Core\Console\Command;

abstract class Command
{
	/**
	 * Tableau des options passé à
	 * la commande
	 *
	 * @var array
	 */
	protected $options = array();

	/**
	 * Crée une nouvel instance
	 *
	 * @param array $options
	 * @return void
	 */
	public function __construct($options)
	{
		$this->options = $options;	
	}

	/**
	 * Excécution d'une commande
	 */
	abstract public function execute();
}
