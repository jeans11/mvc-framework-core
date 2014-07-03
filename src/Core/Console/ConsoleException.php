<?php
namespace Core\Console;

class ConsoleException extends \Exception
{
	const MISSING_ARG = "Aucun arguments passés à la commande";
	 
	const INVALID_ARG = "L'argument donné est invalide";

	public function __construct($message, $code = 0)
	{
		parent::__construct($message, $code);
	}
}
