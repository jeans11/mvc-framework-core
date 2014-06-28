<?php
namespace Core\Controller;

class ControllerException extends \Exception
{
	const CONTROLLER_ERROR = "La classe \"%s\" n'existe pas";

	const METHOD_ERROR = "La classe \"%s\" ne possède pas de méthode \"%s\"";

	public function __construct($message, $code = 0)
	{
		parent::__construct($message, $code);
	}
}
