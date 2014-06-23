<?php
namespace Core\Http;

use Core\Controller\ResolverController;

class HttpResponse
{
	/**
	 * Référence au ResolverController
	 *
	 * @var Core\Controller\ResolverController
	 */
	private $resolveController;

	/**
	 * Crée une nouvelle instance
	 *
	 * @param Core\Controller\ResolverController $resolveController
	 * @return void
	 */
	public function __construct(ResolverController $resolveController)
	{
		$this->resolveController = $resolveController;	
	}

	/**
	 * Envoit la page au navigateur
	 *
	 */
	public function send()
	{
			
	}

	/**
	 * Effectue le traitement
	 */
	private function handle()
	{
		$object = $this->resolveController->getInstanceController();
		$t = call_user_func_array(array(
			$object, 
			$this->resolveController->getMethodName()),
			$this->resolveController->getMethodParameters()
		)
	}
}
