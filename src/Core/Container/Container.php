<?php
namespace Core\Container;

use ArrayAccess;
use ReflectionClass;

class Container implements ArrayAccess
{
	/**
	 * Contiens les noms de classes
	 *
	 * @var array
	 */
	protected $classNames = array();
	
	/**
	 * Contient les instances
	 *
	 * @var array
	 */
	protected $contains = array();	

	/**
	 * Retourne la valeur en fonction
	 * de la clé fournis
	 *
	 * @param string $key
	 * @return mixed
	 */
	protected function make($key)
	{
		return $this->contains[$key];
	}

	protected function register(array $providers)
	{
		foreach ($providers as $key => $value) {
			switch ($value) {
				case empty($value):
					$param = null;
					break;
				case is_string($value):
					$param = $this->getParam[$value];
					break;
				case is_array($value):
					break;
			}

			$className = $this->classNames[$key];
			$this->build($key, $className, $param);
		}
	}

	private function build($key, $className, $param = null) {
		$closure = function() use ($className, $param) {
			return new $className($param);	
		};
		$this->contains[$key] = $closure();
	}

	private function getParam(string $param) {
		if (array_key_exists($param, $this->contains))	{
			return $this->contains[$param];
		}
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
