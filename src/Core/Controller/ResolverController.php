<?php
namespace Core\Controller;

use Core\Routing\RouteMatcher;

class ResolverController
{
	private $matcher;

	public function __construct(RouteMatcher $matcher)
	{
		$this->matcher = $matcher;	
		var_dump($this->matcher);
	}
}
