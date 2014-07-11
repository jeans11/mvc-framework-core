<?php
namespace Core\Facades;

class FormBuilderFacade extends Facade
{
	/**
	 * Retourne l'alias du provider
	 *
	 * @return string
	 */
	public static function getProviders()
	{
		return 'formBuilder';
	}
}
