<?php
namespace Core\Console\Command;

use Core\Facades\ApplicationFacade as App;
use Core\Facades\HttpResponseFacade as Response;
use Core\Console\Output\ValidOutput;

class CreateBundle extends Command
{
	/**
	 * Nom de la commande
	 */
	const COMMAND_NAME = "create:bundle";

	/**
	 * Tableau caractérisant l'architecture
	 * d'un bundle
	 *
	 * @var array
	 */
	private $folders = array(
		'Controllers',
		'config',
		'views'
	);

	/**
	 * Crée une nouvel instance
	 *
	 * @param array $options
	 * @return void
	 */
	public function __construct($options)
	{
		parent::__construct($options);
	}

	/**
	 * Excécute la commande
	 *
	 * @return void
	 */
	public function execute()
	{
		$pathBundle = App::get('path.psr0').'/'.$this->getBundleName();

		mkdir($pathBundle);

		foreach ($this->folders as $folder) {
			mkdir($pathBundle.'/'.$folder);
		}

		Response::send(
			new ValidOutput('Le bundle a bien été crée')
		);
	}

	/**
	 * Retourne le nom du bundle
	 * à créer
	 *
	 * @return string
	 */
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
