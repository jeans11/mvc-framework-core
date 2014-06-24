<?php
namespace Core\View;

use \Twig_Environment;

class View
{
	public function __construct(Twig_Environment $twig)
	{
		$this->twig = $twig;	
	}
}
