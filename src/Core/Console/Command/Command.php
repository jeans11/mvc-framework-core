<?php
namespace Core\Console\Command;

abstract class Command
{
	protected $options = array();

	public function __construct($options)
	{
		$this->options = $options;	
	}

	abstract public function execute();
}
