<?php
namespace Core\Facades;

class ApplicationFacade extends Facade
{
	/**
	 * Retourne l'alias du provider
	 *
	 * @return string
	 */
	public static function getProviders()
	{
		return 'app';
	}
}
