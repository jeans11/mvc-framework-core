<?php
namespace Core\Routing;

use Core\Http\HttpRequest;

class RouteMatcher
{
	/**
	 * Référence au router
	 *
	 * @var Core\Routing\Router
	 */
	private $router;

	/**
	 * Référence à la requête
	 *
	 * @var Core\Http\HttpRequest
	 */
	private $request;

	/**
	 * Crée un nouvel objet
	 *
	 * @param Core\Routing\Router
	 * @param Core\Http\HttpRequest
	 * @return void
	 */
	public function __construct(Router $router, HttpRequest $request)
	{
		$this->router = $router;	
		$this->request = $request;
	}

	/**
	 * Retourne la route qui correspond
	 * à la requête
	 *
	 * @param string $routeName
	 * @return Core\Routing\Route
	 */
	public function match($routeName = "")
	{
		if ($route = $this->matchRoute($routeName)) {
			return $route;	
		}

		throw new RouteException(RouteException::ROUTE_MISSING);
	}

	/**
	 * Compare les routes à la requête
	 * demandé
	 *
	 * @return Core\Routing\Route
	 */
	private function matchRoute($routeName)
	{
		$request = $this->request->uri();

		if (!empty($routeName)) {
			$request = $routeName;			
		}

		foreach ($this->router as $route)	{
			$route->decodeRoute();
			if ($values = $route->match($request, $this->request->method()))	{
				if ($route->hasParams()) {
					$route->setParamsValue(array_slice($values, 1));
				}
				return $route;
			}
		}
	}
}
