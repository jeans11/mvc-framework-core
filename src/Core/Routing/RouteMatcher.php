<?php
namespace Core\Routing;

use Core\Http\HttpRequest;

class RouteMatcher
{
	private $router;

	private $request;

	public function __construct(Router $router, HttpRequest $request)
	{
		$this->router = $router;	
		$this->request = $request;
	}

	public function match()
	{
		if ($route = $this->matchRoute()) {
			return $route;	
		}
	}

	private function matchRoute()
	{
		foreach ($this->router as $route)	{
			if ($values = $route->match($this->request->uri()))	{
				print_r($values);
			}
		}
	}
}
