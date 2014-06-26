<?php
namespace Core\Container;

class ContainerException extends \Exception
{
	const CLASS_NAME = "Une erreur dans le fichier alias.json"

	public function __construct($message, $code = 0)
	{
		parent::__construct($message, $code);
	}
}
