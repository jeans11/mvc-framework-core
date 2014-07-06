<?php
namespace Core\Console\Command;

use Core\Facades\ApplicationFacade as App;

class CreateBundle extends Command
{
	const COMMAND_NAME = "create:bundle";

	private $folders = array(
		'Controllers',
		'config',
		'views'
	);

	public function __construct($options)
	{
		parent::__construct($options)	
	}

	public function execute()
	{
		$pathBundle = App::get('path.psr0').'/'.$this->getBundleName();

		mkdir($pathBundle);

		foreach ($this->folders as $folder) {
			mkdir($pathBundle.'/'.$folder);
		}
	}

	public function getBundleName()
	{
		if (isset($this->options[1])) {
			return $this->options[1];
		}
		
		$message = sprintf(
			CommandException::MISSING_ARG,
			self::COMMAND_NAME
		);
		throw new CommandException($message);
	}
}
