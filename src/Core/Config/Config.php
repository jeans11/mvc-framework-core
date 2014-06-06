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
	private $configs = array();

	/**
	 * Chemin vers la config principale
	 *
	 * @var string
	 */
	protected $configPath = "";

	protected $psr0 = "";

	/**
	 * Créer un nouvel objet Config
	 *
	 * @param string $configPath
	 */
	public function __construct($configPath, $psr0)
	{
		$this->configPath = $configPath;	
		$this->psr0 = $psr0;
	}
	
	public function get($key)
	{
		$this->configs[$key] = $this->load($key);
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
