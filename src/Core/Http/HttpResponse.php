<?php
namespace Core\Http;

use Core\Controller\ResolverController;

class HttpResponse
{
	private $resolveController;

	public function __construct(ResolverController $resolveController)
	{
		$this->resolveController = $resolveController;	
		var_dump($this->resolveController);
	}
}
