<?php
namespace Core\Exception;

use Core\Http\HttpResponse;
use Core\Facades\ViewFacade as View;

class HandlerException
{
	/**
	 * Affichage des erreurs
	 *
	 * @var string
	 */
	private static $view = 'Core/Exception/Support/viewException.html';

	/**
	 * Instance HttpResponse
	 *
	 * @var Core\Http\HttpResponse
	 */
	private $response;

	/**
	 * Crée une instance
	 *
	 * @param Core\Http\HttpResponse
	 * @return void
	 */
	public function __construct(HttpResponse $response)
	{
		$this->response = $response;	
	}

	/**
	 * Enregistre le gestionnaire
	 * d'exception
	 *
	 * @return void
	 */
	public function setExceptionHandler()
	{
		set_exception_handler(array($this, 'exceptionHandler'));
	}

	/**
	 * Méthode appelée par le gestionnaire
	 * d'exception. Affichage l'erreur
	 *
	 * @param Exception $exception
	 * @return void
	 */
	public function exceptionHandler($exception)
	{
		$content = $this->prepareContent($exception);

		$this->response->send($content);
	}

	/**
	 * Prépare le contenu de l'exception
	 *
	 * @param Exception $excpetion
	 * @return string
	 */
	private function prepareContent($exception)
	{
		return View::create(
			static::$view, 
			array(
				'message' => $exception->getMessage()
			)
		);
	}
}
