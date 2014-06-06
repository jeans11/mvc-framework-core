<?php
namespace Core\Config;

class FileLoader
{
	/**
	 * Appel de certains traits
	 */
	use \Core\Bracket\Traits\ParseJsonTrait;

	/**
	 * Chargement de la configuration
	 * demandée
	 *
	 * @param string $key
	 * @return array
	 */
	protected function load($key)
	{
		if (file_exists($file = self::$configPath."/$key.json")) {
			return $this->parseJson($file);
		}
	}
}


