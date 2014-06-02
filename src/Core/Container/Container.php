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
					$className = $this->classNames[$key];
					$params = null;
					break;
				case is_string($value):
					break;
				case is_array($value):
					break;
			}

			$this->build($key, $params);
		}
	}

	private function build(string $className, $params = null) {
		
		$this->instances[$key] = function() use ($className) {
			return new $className();	
		}
	}

	private function getParams(array $params) {
			
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
