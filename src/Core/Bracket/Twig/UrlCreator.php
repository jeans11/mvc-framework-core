<?php
namespace Core\Bracket\Twig;

class UrlCreator
{
	/**
	 * Fonction pour Twig permettant
	 * de générer une url quelque soit
	 * le server
	 *
	 * @param  string $uri
	 * @return string
	 */
	public function create($uri)
	{
		$host          = $_SERVER['HTTP_HOST'];
		$scriptName    = $_SERVER['SCRIPT_NAME'];

		if (isset($_SERVER['HTTPS'])) {
			if ($_SERVER['HTTPS'] == 'on') {
				$requestScheme = 'https';
			}
		} else {
			$requestScheme = 'http';
		}

		$url           = $requestScheme.'://'.$host.preg_replace('/index.php\/?.*/','',$scriptName).$uri;
		return $url;
	}
}
