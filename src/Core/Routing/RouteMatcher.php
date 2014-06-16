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
		if ($route = $this->matchRoute($this->router)) {
			return $route;	
		}
	}

	private function matchRoute(Router $router)
	{
		foreach ($router as $route)	{
			var_dump($route);
		}

		die;
	}
}
