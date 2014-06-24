<?php
namespace Core\View;

use \Twig_Environment;

class View
{
	/**
	 * Crée une nouvelle instance
	 *
	 * @param Twig_Environment $twig
	 * @return void
	 */
	public function __construct(Twig_Environment $twig)
	{
		$this->twig = $twig;	
	}

	/**
	 * Crée une nouvelle vue et retourne son contenu
	 *
	 * @param string $file
	 * @param array $vars
	 * @return string
	 */
	public function create($file, $vars = array())
	{
		$view = $this->twig->loadTemplate($file);
		return $view->render($vars);
	}
}
