<?php
namespace Core\Exception;

class HandlerException
{
	public static function setExceptionHandler()
	{
		set_exception_handler(array(static, 'exceptionHandler'));
	}

	public function exceptionHandler($exception)
	{
		exit($exception->getMessage());
	}
}
