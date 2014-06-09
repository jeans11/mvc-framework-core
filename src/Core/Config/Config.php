<?php
namespace Core\Config;

use ArrayAccess;

class Config extends FileLoader implements ArrayAccess
{
	/**
	 * Tableau contenant la config
	 *
	 * @var array
	 */
	protected static $configs = array();

	/**
	 * Chemin vers la config principale
	 *
	 * @var string
	 */
	protected static $configPath = "";

	/**
	 * Chemin vers la librairie de l'application
	 *
	 * @param string $psr0
	 */
	protected static $psr0 = "";

	/**
	 * Créer un nouvel objet Config
	 *
	 * @param string $configPath
	 */
	public function __construct($configPath, $psr0)
	{
		static::$configPath = $configPath;	
		static::$psr0 = $psr0;
	}
	
	public function get($key)
	{
		if ($this->offsetExists($key)) {
			return $this->configs[$key];
		} else {
			return static::$configs[$key] = $this->load($key);
		}
	}

	/**
	 * Retourne  
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function offsetGet($key)
	{
		return $this->get($key);
	}

	public function offsetSet($key, $value)
	{
	
	}

	public function offsetExists($key)
	{
		return isset($this->configs[$key]);
	}

	public function offsetUnset($key)
	{
		unset($this->configs[$key]);
	}
}
