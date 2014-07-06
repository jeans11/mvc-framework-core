<?php
namespace Core\Console\Command;

class CommandException extends \Exception
{
	const MISSING_ARG = "La commande %s a besoin d'un ou plusieurs arguments";

	public function __construct($message, $code = 0)
	{
		parent::__construct($message, $code);
	}
}
