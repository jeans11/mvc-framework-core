<?php
namespace Core\Bracket\Traits;

class ParseJsonException extends \Exception
{
	const SYNTHAXE_ERROR = "Il y a une erreur de synthaxe dans l'un des fichiers de configuration (.json)";

	public function __construct($message, $code = 0)
	{
		parent::__construct($message, $code);
	}
}
