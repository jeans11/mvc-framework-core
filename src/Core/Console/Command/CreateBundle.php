<?php
namespace Core\Console\Command;

use Core\Facades\ApplicationFacade as App;

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
		$pathBundle = App::get('path.psr0').'/'.$this->name;

		mkdir($pathBundle);

		foreach ($this->folders as $folder) {
			mkdir($pathBundle.'/'.$folder);
		}
	}


}
