<?php
namespace Core\Facades;

class ViewFacade extends Facade
{
	/**
	 * Retourne l'alias du provider
	 *
	 * @return string
	 */
	public static function getProviders()
	{
		return 'view';
	}
}
