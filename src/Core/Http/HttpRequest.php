<?php
namespace Core\Http;

class HttpRequest
{
	/**
	 * Vérifie qu'un paramètre existe 
	 * pour une requête GET
	 *
	 * @param string $key
	 * @return boolean
	 */

	public function getExist($key) {
		return isset($_GET[$key]);
	}	

	/**
	 * Retourne la valeur d'un paramètre ou null
	 * pour une requête GET
	 *
	 * @param string $key
	 * @return mixed
	 */

	public function getData($key) {
		return $this->getExist($key) ? $_GET[$key] : null;
	}

	/**
	 * Vérifie qu'un paramètre existe 
	 * pour une requête POST
	 *
	 * @param string $key
	 * @return boolean
	 */

	public function postExist($key) {
		return isset($_POST[$key]);
	}

	/**
	 * Retourne la valeur d'un paramètre ou null
	 * pour une requête POST
	 *
	 * @param string $key
	 * @return mixed
	 */

	public function postData($key) {
		return $this->postExist($key) ? $_POST[$key] : null;
	}

	/**
	 * Retourne la méthode utilisé
	 *
	 * @return string
	 */

	public function method() {
		return $_SERVER['REQUEST_METHOD'];
	}

	/**
	 * Retourne l'URI de la requête
	 *
	 * @return string
	 */

	public function uri() {
		return $_SERVER['REQUEST_URI'];
	}

	/**
	 * Ajoute des donnée
	 * à la variable $_GET
	 *
	 * @param array $data
	 * @return void
	 */

	public function addGET(array $data)
	{
		$_GET = array_merge($_GET, $data);
	}
}
