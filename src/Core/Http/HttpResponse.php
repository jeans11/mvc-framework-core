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
	 * Envoit la page au navigateur
	 *
	 * @param string $content
	 * @return void
	 */
	public function send($content = null)
	{
		if (is_null($content)) {
			$content = $this->handle();	
		}

		exit($content);	
	}

	/**
	 * Execute le controller et la méthode
	 * associé
	 *
	 * @return mixed
	 */
	private function handle()
	{
		$object = $this->resolveController->getInstanceController();
		$return = call_user_func_array(array(
			$object, 
			$this->resolveController->getMethodName()),
			$this->resolveController->getMethodParameters()
		);
		return $return;
	}

	public function setResolverController(ResolverController $resolveController)
	{
		$this->resolveController = $resolveController;	
		return $this;
	}
}
