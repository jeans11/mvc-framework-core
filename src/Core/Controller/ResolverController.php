<?php
namespace Core\Controller;

use Core\Routing\RouteMatcher;

class ResolverController
{
	private $matcher;

	private $routeMatched;

	public function __construct(RouteMatcher $matcher)
	{
		$this->matcher = $matcher;	
		$this->setRouteMatched();
	}

	public function getController()
	{
		$className = $this->routeMatched->controller;	
		echo $className;
	}

	public function getMethod()
	{
	
	}

	public function getRouteMatched()
	{
		return 	$this->routeMatched;
	}

	private function setRouteMatched()
	{
		$this->routeMatched = $this->matcher->match();	
	}
}
