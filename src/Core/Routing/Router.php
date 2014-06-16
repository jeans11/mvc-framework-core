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

	/**
	 * Retourne la valeur de la clé
	 * correspondante
	 *
	 * @param  string $key
	 * @return mixed 
	 */
	private function get($key)
	{
		return $this->routes[$key];
	}

	/**
	 * Assigne une valeur 
	 *
	 * @param  string $key
	 * @param  mixed  $value
	 * @return void
	 */
	private function set($key, $value)
	{
		$this->routes[$key]	= $value;
	}

	/*
	 * Retourne la valeur de la clé
	 * correpondante
	 *
	 * @param  string $key
	 * @return mixed
	 */
	public function offsetGet($key)
	{
		return $this->get($key);
	}

	/**
	 * Assigne une valeur 
	 *
	 * @param  string $key
	 * @param  mixed  $value
	 * @return void
	 */
	public function offsetSet($key, $value)
	{
		return $this->set($key,$value);
	}

	/**
	 * Vérifie si la clé existe
	 *
	 * @param  string $key
	 * @return boolean 
	 */
	public function offsetExists($key)
	{
		return isset($this->routes[$key]);
	}
	
	/**
	 * Supprime une entrée
	 *
	 * @param  string $key
	 * @return boolean 
	 */
	public function offsetUnset($key)
	{
		unset($this->routes[$key]);
	}
}
