<?php
namespace Core\Http;

class Redirection
{
	/**
	 * Instance HttpRequest
	 *
	 * @var Core\Http\HttpRequest
	 */
	private $request;

	/**
	 * Crée une nouvelle instance
	 *
	 * @param HttpRequest $request
	 */
	public function __construct(HttpRequest $request)
	{
		$this->request = $request;	
	}

	/**
	 * Redirection vers la route indiqué (provisoire)
	 *
	 * @param String $route
	 */
	public function to($route)
	{
		header('Location: '.$this->uri($route));
	}

	/**
	 * Retourne l'uri à utiliser
	 *
	 * @param  String $route
	 * @return String
	 */
	private function uri($route)
	{
		$pattern = ($route != '/') ? '' : '\/';
		preg_match('/(.*)'.$pattern.'index.php/', $this->request->phpSelf(), $matches);

		if (isset($matches[1])) {
			$uri = $matches[1].$route;
			return $uri;
		}
	}
}
