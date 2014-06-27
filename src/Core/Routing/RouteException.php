<?php
namespace Core\Routing;

class RouteException extends \Exception
{
	const ROUTE_MISSING = "La route demandée n'existe pas";

	const PARAMETRE_ERREUR = "Le paramètre \"%s\" n'existe pas dans la clause WHERE de la route";

	public function __construct($message, $code = 0)
	{
		parent::__construct($message, $code);
	}
}
