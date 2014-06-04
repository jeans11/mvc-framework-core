<?php
namespace Core\Config;

use ArrayAccess;

class Config implements ArrayAccess
{
	/**
	 * Tableau contenant la config
	 *
	 * @var array
	 */
	private $configs = array();

	/**
	 * Chemin vers la config
	 *
	 * @var string
	 */
	private $configPath = null;

	/**
	 * Créer un nouvel objet Config
	 *
	 * @param string $configPath
	 */
	public function __construct($configPath)
	{
		$this->configPath = $configPath;	
	}

	/**
	 * Retourne  
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function offsetGet($key)
	{
	
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
