<?php
namespace Core\Facades;

class ConfigFacade extends Facade
{
	/**
	 * Retourne l'alias du provider
	 *
	 * @return string
	 */
	public static function getProviders()
	{
		return 'config';
	}
}
