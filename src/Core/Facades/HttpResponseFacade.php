<?php
namespace Core\Facades;

class HttpResponseFacade extends Facade
{
	/**
	 * Retourne l'alias du provider
	 *
	 * @return string
	 */
	public static function getProviders()
	{
		return 'httpResponse';
	}
}
