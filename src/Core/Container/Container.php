<?php
namespace Core\Container;

use ArrayAccess;
use ReflectionClass;

class Container implements ArrayAccess
{
	/**
	 * Contiens les services
	 *
	 * @var array
	 */
	protected $contains = array();

	protected function make($key)
	{
		return $this->contains[$key];
	}

	/**
	 * Vérifie si la clé existe
	 *
	 * @param string $key
	 * @return bool
	 */
	public function offsetExists($key)
	{
		return isset($this->contains[$key]);
	}

	/**
	 * Retourne une instance de l'alias
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function offsetGet($key)
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
	public function offsetSet($key, $value)
	{

	}

	/**
	 * Supprime une entrée
	 *
	 * @param string $key
	 * @return void
	 */
	public function offsetUnset($key)
	{
		unset($this->contains[$key]);
	}
}
