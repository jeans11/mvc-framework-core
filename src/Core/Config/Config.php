<?php
namespace Core\Config;

use ArrayAccess;

class Config extends Fileloader implements ArrayAccess
{
	private $configs = array();

	private $configPath = null;

	public function __construct(string $configPath)
	{
		$this->configPath = $configPath;	
	}

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
