<?php
namespace Core\Controller;

use Core\Routing\RouteMatcher;

class ResolverController
{ 

	use \Core\Bracket\Traits\ReflectionClassTrait;

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
	 * Référence du controller résolu
	 * 
	 * @var ReflectionClass
	 */
	private $class;

	/**
	 * Crée une instance
	 *
	 * @param Core\Routing\RouteMatcher
	 */
	public function __construct(RouteMatcher $matcher)
	{
		$this->matcher = $matcher;	
	}

	/**
	 * Match la route et dispatch
	 * certains attribut
	 *
	 * @return void
	 */
	public function getController()
	{
		$this->routeMatched = $this->matcher->match();	

		$this->class = $this->getReflectionClass($this->routeMatched->controller);
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
	 * Retourne l'instance du controller
	 * à invoké.
	 *
	 * @return mixed
	 */
	public function getInstanceController()
	{
		$args = array();

		$this->getController();
		
		if ($this->class->hasMethod('__construct')) {
			$args = $this->getArgsContructeur($class);
		}

		return $this->class->newInstanceArgs($args);
	}

	/**
	 * Retourne un tableau des valeurs
	 * à passer à l'action
	 *
	 * @return array
	 */
	public function getMethodParameters()
	{
		$paramsValue = array();

		if ($this->class->hasMethod($this->getMethodName())) {
			$method = $this->class->getMethod($this->getMethodName());
			foreach ($method->getParameters() as $param) {
				$paramsValue[] = $this->routeMatched->paramsValue[$param->name];
			}
		}

		return $paramsValue;
	}

	/**
	 * Retourne sous forme de tableau
	 * les arguments que le controller
	 * à besoin d'invoquer 
	 *
	 * @param RelectionClass
	 * @return array
	 */
	private function getArgsConstructeur($class)
	{
		$constructeur = $class->getConstructor();	
		
		foreach ($constructeur->getParameters() as $params) {
				
		}
	}
}

