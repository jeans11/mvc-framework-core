<?php
namespace Core\Routing;

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

	public function match($url)
	{
		if (preg_match('`'.$this->url.'$`', $url, $matches)) {
			return $matches;	
		} else {
			return false;	
		}
	}

	public function compileRoute()
	{
		$this->url = preg_replace(/{(.*)}/, '('.$this->where[$1].')', $this->url);
	}
}
