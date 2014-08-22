<?php
namespace Core\Bracket\Twig;

use Core\Controller\ResolverController;

class Route
{
	/**
	 * Crée une nouvelle instance 
	 *
	 * @param Core\Controller\ResolverController $resolver;
	 * @return void
	 */
	public function __construct(ResolverController $resolver)
	{
		$this->resolver = $resolver;	
	}

	/**
	 * Execute la route passé en paramètre
	 *
	 * @param string $routeName
	 * @return mixed
	 */
	public function exec($routeName)
	{
		$object = $this->resolver->getInstanceController($routeName);
		return call_user_func_array(array(
			$object, 
			$this->resolver->getMethodName()),
			$this->resolver->getMethodParameters()
		);
	}
}
