<?php
namespace Core\Routing;

class RouteException extends \Exception
{
	const ROUTE_MISSING = "La route demandée n'existe pas";

	public function __construct($message, $code = 0)
	{
		parent::__construct($message, $code);
	}
}
