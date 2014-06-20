<?php
namespace Core\Controller;

use Core\Routing\RouteMatcher;

class ResolverController
{ 

	use Core\Bracket\Traits\ReflectionClassTrait;

	/**
	 * Instance de RouteMatcher
	 *
	 * @var Core\Routing\RouteMatcher
	 */
	private $matcher;

	/**
	 * Route matchée
	 *
	 * @var Core\Routing\Route
	 */
	private $routeMatched;

	/**
	 * Crée une instance
	 *
	 * @param Core\Routing\RouteMatcher
	 */
	public function __construct(RouteMatcher $matcher)
	{
		$this->matcher = $matcher;	
		$this->setRouteMatched();
	}

	/**
	 * Retourne le nom du controller
	 * à invoquer
	 *
	 * @return string
	 */
	public function getControllerName()
	{
		return $this->routeMatched->controller;	
	}

	/**
	 * Retourne le nom de la méthode
	 * à exécuter
	 *
	 * @return string
	 */
	public function getMethodName()
	{
		return $this->routeMatched->action;	
	}

	/**
	 * Retourne la route matchée
	 *
	 * @return Core\Routing\Route
	 */
	public function getRouteMatched()
	{
		return $this->routeMatched;
	}

	/**
	 * Informe de la route matchée
	 *
	 * @return void
	 */
	private function setRouteMatched()
	{
		$this->routeMatched = $this->matcher->match();	
	}

	/**
	 * Retourne l'instance du controller
	 * à invoké.
	 *
	 * @return mixed
	 */
	public function getInstanceController()
	{
		$class = $this->getReflectionClass($this->getControllerName());
		var_dump($class);
	}
}

