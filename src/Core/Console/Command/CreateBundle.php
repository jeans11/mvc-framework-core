<?php
namespace Core\Console\Command;

class CreateBundle
{
	private $name;

	private $folders = array(
		'Controllers',
		'config',
		'views'
	);

	public function __construct($name)
	{
		$this->name = $name;	
	}

	public function execute()
	{
		mkdir('/home/jean/Documents/www-dev/lab/petty_archi/app/Lib/'.$this->name);
	}


}
