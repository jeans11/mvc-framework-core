<?php
namespace Core\Exception;

use Core\Http\HttpResponse;
use Core\Facades\ViewFacade as View;

class HandlerException
{
	private static $view = 'Core/Exception/Support/viewException.html';

	private $response;

	public function __construct(HttpResponse $response)
	{
		$this->response = $response;	
	}

	public function setExceptionHandler()
	{
		set_exception_handler(array($this, 'exceptionHandler'));
	}

	public function exceptionHandler($exception)
	{
		$content = $this->prepareContent($exception);

		$this->response->send($content);
	}

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
