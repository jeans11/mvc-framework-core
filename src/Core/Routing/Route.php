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
	public function match($url)
	{
		if (preg_match('`'.$this->url.'$`', $url, $matches)) {
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
		$this->replaceParams();
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
			$this->url = preg_replace('/\{'.$param.'\}/', (string) RegExFactory::get($this->where[$param]), $this->url);
		}		
	}
}
