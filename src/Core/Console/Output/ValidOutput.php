<?php
namespace Core\Console\Output;

class ValidOutput extends Output
{
	/**
	 * Couleur
	 *
	 * @const string
	 */
	const COLOR = "\033[32m%s";

	/**
	 * Crée une instance
	 *
	 * @param string $msg
	 * @return void
	 */
	public function __construct($msg)
	{
		parent::__construct($msg);
	}

	/**
	 * Retourne la couleur
	 *
	 * @return string
	 */
	public function getColor()
	{
		return self::COLOR;	
	}
}
