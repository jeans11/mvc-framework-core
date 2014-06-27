<?php
namespace Core\Container;

class ContainerException extends \Exception
{
	const CLASS_NAME = "Aucune correspondance pour la clé %s";

	public function __construct($message, $code = 0)
	{
		parent::__construct($message, $code);
	}
}
