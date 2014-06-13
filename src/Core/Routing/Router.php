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

	/**
	 * Modifie les routes
	 *
	 * @param array $routes
	 * @return void
	 */
	public function setRoutes($routes = array())
	{
		$this->routes = $routes;	
	}
}
