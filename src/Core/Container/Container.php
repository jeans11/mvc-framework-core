<?php
namespace Core\Container;

use ArrayAccess;
use Closure;
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

	/**
	 * Analyse les providers
	 *
	 * @param array $providers
	 * @return void
	 */
	protected function register(array $providers)
	{
		foreach ($providers as $key => $value) {
			switch ($value) {
				case null: 
					$param = null;
					break;
				case is_string($value):
					$param = $this->getParam($value);
					break;
				case is_array($value):
					$param = array_map(array($this,'getParam'), $value);
					break;
			}
			$className = $this->getClassName($key);
			$closure = $this->getClosure($key, $className, $param);
			$this->build($key, $closure);
		}
	}
	
	/**
	 * Retourne la closure
	 *
	 * @param string $key
	 * @param string $className
	 * @param mixed $param
	 */
	private function getClosure($key, $className, $param = null) {
		return function() use ($className, $param) {
			switch($param) {
				case null: 
					return new $className();
					break;
				case is_string($param) || is_object($param):
					return new $className($param);
					break;
				case is_array($param):
					$nb = count($param);
					switch($nb) {
						case 2:
							return new $className($param[0], $param[1]);
							break;
						case 3:
							return new $className($param[0], $param[1], $param[2]);
							break;
						case 4:
							return new $className($param[0], $param[1], $param[2],$param[3]);
							break;
					}
					break;
			}
		};
	}

	/**
	 * Ajoute un provider au container 
	 *
	 * @param closure $closure
	 * @return void
	 */
	private function build($key, Closure $closure) {
		$this->contains[$key] = $closure();
	}

	/**
	 * Retourne la valeur de la clé
	 *
	 * @param string $param
	 * @return mixed
	 */
	private function getParam($key) {
		// Le paramètre est une simple chaîne
		$param = $key;

		// Le paramètre est un objet 
		if (array_key_exists($key, $this->contains)) {
			$param = $this->contains[$key];
		}

		// Le paramètre est un paramètre de la configuration
		if (preg_match('/config\.([a-zA-Z]*)\.([a-zA-Z]*)/', $key, $matches)) {
			$param = $this['config'][$matches[1]][$matches[2]];
		}

		return $param;
	}

	/**
	 * Retourne le nom de la classe suivant
	 * la clé
	 *
	 * @param string $key
	 * @return mixed
	 */
	private function getClassName($key)
	{
		if (isset($this->classNames[$key])) {
			return $this->classNames[$key];
		}

		throw new ContainerException(sprintf(ContainerException::CLASS_NAME, $key));
	}

	/**
	 * Retourne l'alias du provider
	 * suivant le nom de la classe
	 *
	 * @param  string $className
	 * @return array
	 */
	public function getAliasProvider($className)
	{
		return array_keys($this->classNames, $className);
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
		$this->contains[$key] = $value;
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
