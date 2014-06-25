<?php
namespace Core\Exception;

use Core\Facades\ViewFacade as View;

class HandlerException
{
	const VIEW_EXCEPTION = 'Core/Exception/Support/viewException.html';

	public function setExceptionHandler()
	{
		set_exception_handler(array($this, 'exceptionHandler'));
	}

	public function exceptionHandler($exception)
	{
		return View::create(VIEW_EXCEPTION, array('message' => $exception->getMessage()));
	}
}
