<?php
namespace Core\Facades;

class RedirectionFacade extends Facade
{
	/**
	 * Retourne l'alias du provider
	 *
	 * @return string
	 */
	public static function getProviders()
	{
		return 'redirection';
	}
}
