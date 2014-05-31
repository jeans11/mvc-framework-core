<?php
namespace Core\Container;

use ArrayAccess;

class Container extends ReflectionClass implements ArrayAccess
{
	/**
	 * Contiens les services
	 *
	 * @var array
	 */
	protected $contains = array();

	/**
	 * Vérifie si la clé existe
	 *
	 * @param string $key
	 * @return bool
	 */
	protected function offsetExists($key)
	{
		return isset($this->contains[$key]);
	}

	/**
	 * Retourne une instance de l'alias
	 *
	 * @param string $key
	 * @return mixed
	 */
	protected function offsetGet($key)
	{
		return $this->make($key);
	}

	/**
	 * Assigne la valeur à l'alias
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return void
	 */
	protected function offsetSet($key, $value)
	{

	}
}
