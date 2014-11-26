<?php
namespace Core\Facades;

class UploadManagerFacade extends Facade
{
	/**
	 * Retourne l'alias du provider
	 *
	 * @return string
	 */
	public static function getProviders()
	{
		return 'uploadManager';
	}
}
