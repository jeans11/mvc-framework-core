<?php
namespace Core\Routing;

use Core\Bracket\RegEx\RegExFactory;

class Route
{
	/**
	 * Tableau des attributs
	 *
	 * @var array
	 */
	private $attributes = array();

	/**
	 * Crée un nouvel objet
	 *
	 * @param array $route
	 * @return void
	 */
	public function __construct($route = array()) {
		$this->hydrate($route);
	}

	/**
	 * Assignation des attributs et des valeurs
	 *
	 * @param array $data
	 * @return void
	 */
	private function hydrate($data)
	{
		foreach ($data as $key => $value) {
			$this->$key = $value;
		}
	}

	/**
	 * Retourne la valeur d'un attribut
	 *
	 * @param string $attribut
	 * @return mixed
	 */
	public function __get($attribute)
	{
		if (isset($this->attributes[$attribute])) {
			return $this->attributes[$attribute];
		}
	}

	/**
	 * Assigne les valeurs aux attributs
	 *
	 * @param string $attributes
	 * @param mixed $value
	 * @return void
	 */
	public function __set($attribute, $value)
	{
		$this->attributes[$attribute] = $value;
	}

	/**
	 * Retourne l'url et les paramètres matchés
	 *
	 * @param string $url
	 * @return mixed
	 */
	public function match($url, $method = 'GET')
	{
		if (!$this->method) {
			$this->method = 'GET';
		}

		if (preg_match('`'.$this->url.'$`', $url, $matches) && $method == $this->method) {
			return $matches;	
		} else {
			return false;	
		}
	}

	/**
	 * Décode l'url de la route
	 *
	 * @return void
	 */
	public function decodeRoute()
	{
		$this->paramsName = $this->extractParams(); 

		if ($this->hasParams()) {
			$this->replaceParams();
		}
	}

	/**
	 * Extrait les paramètres de la route
	 *
	 * @return array
	 */
	private function extractParams()
	{
		preg_match_all('#\{(\w*)\}#', $this->url, $matches);
		return $matches[1];
	}
	
	/**
	 * Remplace les paramètres de la route
	 * par une expression régulière
	 *
	 * @return void
	 */
	private function replaceParams()
	{
		foreach ($this->paramsName as $param) {
			$this->url = preg_replace('/\{'.$param.'\}/', '('.(string) RegExFactory::get($this->getWhere($param)).')', $this->url);
		}		
	}

	/**
	 * Vérifie la présence de
	 * paramètre
	 *
	 * @return boolean
	 */
	public function hasParams()
	{
		return $this->paramsName != array();	
	}

	/**
	 * Affecte aux paramètres les valeurs
	 * correspondantes
	 *
	 * @param array $data
	 * @return void
	 */
	public function setParamsValue($data)
	{
		$this->paramsValue = $this->getParamsValue($data);
	}

	/**
	 * Construit un tableau clé => valeur
	 * avec pour chaque paramètre la valeur
	 * matché
	 *
	 * @param array $data
	 * @return array
	 */
	private function getParamsValue($data)
	{
		$paramsValue = array();

		foreach ($data as $key => $value) {
			$paramsValue[$this->paramsName[$key]] = $value;
		}

		return $paramsValue;
	}

	private function getWhere($key)
	{
		if (isset($this->where[$key])) {
			return $this->where[$key];
		}

		throw new RouteException(sprintf(RouteException::PARAMETRE_ERREUR, $key));
	}
}
