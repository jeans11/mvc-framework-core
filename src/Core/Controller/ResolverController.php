<?php
namespace Core\Controller;

use Core\Routing\RouteMatcher;
use ReflectionClass;
use ReflectionMethod;

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
	 * @param string $routeName
	 * @return void
	 */
	public function getController($routeName = "")
	{
		$this->routeMatched = $this->matcher->match($routeName);	

		if (class_exists($this->routeMatched->controller)) {
			$this->class = $this->getReflectionClass($this->routeMatched->controller);
		} else {
			$message = sprintf(
				ControllerException::CONTROLLER_ERROR,
				$this->routeMatched->controller
			);

			throw new ControllerException($message);
		}
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
	 * @param string $routeName
	 * @return mixed
	 */
	public function getInstanceController($routeName = "")
	{
		$args = array();

		$this->getController($routeName);
		
		if ($this->class->hasMethod('__construct')) {
			$args = $this->getArgsConstructeur();
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
			return $paramsValue;
		}

		$message = sprintf(
			ControllerException::METHOD_ERROR,
			$this->class->getName(),
			$this->getMethodName()	
		);

		throw new ControllerException($message);
	}

	/**
	 * Retourne sous forme de tableau
	 * les arguments que le controller
	 * à besoin d'invoquer. Appeler de
	 * façon récurssive
	 * 
	 * @param mixed
	 * @return array
	 */
	private function getArgsConstructeur(ReflectionClass $reflection = null)
	{
		$args = array();

		// Retourne une instance de ReflectionMethod
		// ou NULL dans le cas où la classe n'a pas de
		// constructeur
		$constructeur = $this->getConstructeur($reflection);

		// Vérifie s'il s'agit bien d'une ReflectionMethod
		if (!$this->isConstructeur($constructeur)) {
			return $args;
		}
		
		foreach ($constructeur->getParameters() as $param) {
			$class = $param->getClass();
			$args[] = $class->newInstanceArgs($this->getArgsConstructeur($class));
		}

		return $args;
	}

	/**
	 * Retourne une instance de ReflectionMethod
	 *
	 * @param mixed
	 * @return ReflectionMethod
	 */
	private function getConstructeur($reflection)
	{
		if (is_null($reflection)) {
			$constructeur = $this->class->getConstructor();
		} else {
			$constructeur = $reflection->getConstructor();	
		}

		return $constructeur;
	}

	/**
	 * Vérifie si l'argument est de type
	 * ReflectionMethod
	 *
	 * @param mixed
	 * @return boolean
	 */
	private function isConstructeur($constructeur)
	{
		return $constructeur instanceof ReflectionMethod;	
	}
}

