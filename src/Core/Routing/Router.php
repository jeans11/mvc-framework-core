<?php
namespace Core\Routing;

use Core\Http\HttpRequest;

class Router
{
	/**
	 * Référence HttpRequest
	 *
	 * @var Core\Http\HttpRequest
	 */		
	private $httpRequest;

	/**
	 * Tableau des routes
	 *
	 * @var array
	 */
	private $routes = array();

	/**
	 * Crée une instance 
	 *
	 * @param Core\Http\HttpRequest
	 * @return void
	 */

	public function __construct(HttpRequest $httpRequest) {
		$this->httpRequest = $httpRequest;
	}

	public function setRoutes($routes = array())
	{
		print_r($routes);
	}
}
