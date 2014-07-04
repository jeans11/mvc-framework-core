<?php
namespace Core\Console\Output;

class ErrorOutput extends Output
{
	const COLOR = '\033[31m';

	public function __construct($msg)
	{
		parent::__construct($msg);
	}

	public function getColor()
	{
		return self::COLOR;	
	}
}
