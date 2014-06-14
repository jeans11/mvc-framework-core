<?php
namespace Core\Routing;

class Route
{
	/**
	 * Tableau des attributs
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

	private function hydrate($data)
	{
		print_r($data);
	}

	public function __get($attribute)
	{
		if (isset($value = $this->attributes[$attribute])) {
			return $value;
		}
	}

	public function __set($attribute, $value)
	{
		$this->attributes[$attribute] = $value;
	}
}
