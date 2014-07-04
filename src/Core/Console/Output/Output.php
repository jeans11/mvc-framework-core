<?php
namespace Core\Console\Output;

abstract class Output
{
	protected $msg;

	public function __construct($msg)
	{
		$this->msg = $msg;	
	}

	protected function decode()
	{
		return static::getColor().$this->msg;		
	}

	protected function __toString()
	{
		return $this->decode();	
	}

	abstract protected function getColor();
}
