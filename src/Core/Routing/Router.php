<?php
namespace Core\Routing;

use Core\Http\HttpRequest;
use ArrayAccess;

class Router implements ArrayAccess
{
	/**
	 * Tableau des routes
	 *
	 * @var array
	 */
	private $routes = array();

	/**
	 * Modifie les routes
	 *
	 * @param array $routes
	 * @return void
	 */
	public function setRoutes($routes = array())
	{
		$this->buildRoute($routes);	
	}

	/**
	 * Crée pour chaque route un objet
	 * Route
	 *
	 * @param array $routes
	 * @return array
	 */
	private function buildRoute($routes) {
		foreach	($routes as $route) {
			$this[] = new Route($route);
		}
	}

	private function get($key)
	{
		return $this->routes[$key];
	}

	private function set($key, $value)
	{
		$this->routes[$key]	= $value;
	}

	public function offsetGet($key)
	{
		return $this->get($key);
	}

	public function offsetSet($key, $value)
	{
		return $this->set($key,$value);
	}

	public function offsetExists($key)
	{
		return isset($this->routes[$key]);
	}

	public function offsetUnset($key)
	{
		unset($this->routes[$key]);
	}
}
