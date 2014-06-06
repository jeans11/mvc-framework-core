<?php
namespace Core\Config;

class FileLoader
{
	protected function load($key)
	{
		if ($file = file_exists(self::$configPath."/$key.json")) {
			echo $file;
		}
	}
}


