<?php
namespace Core\Console\Output;

class ErrorOutput extends Output
{
	/**
	 * Couleur
	 *
	 * @const string
	 */
	const COLOR = "\033[31m%s";

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
