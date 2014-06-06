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
		if (file_exists($file = static::$configPath."/$key.json")) {
			return $this->parseJson($file);
		} else {
			return $this->getConfigBundles($key);
		}
	}

	/**
	 * Chargement de la configuration
	 * demandée pour chaque bundle
	 *
	 * @param string $key
	 * @return array
	 */
	private function getConfigBundles($key)
	{
		$merge = array();
		foreach (static::$configs['bundle'] as $bundle)	{
			if (file_exists($file = static::$psr0."/ucfirst($bundle)/"."/config/".$key))	{
				$merge = array_merge($merge, $this->parseJson($file));
			}
		}
		print_r($merge);
		die;
		return $merge;
	}
}


