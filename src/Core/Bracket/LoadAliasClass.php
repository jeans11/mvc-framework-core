<?php
namespace Core\Bracket;

class LoadAliasClass
{
	/**
	 * Instance singleton
	 *
	 * @var \Core\Bracket\LoadAliasClass
	 */
	private static $instance;

	/**
	 * Crée un nouvelle instance
	 *
	 * @param array $aliases
	 * @return void
	 */
	public function __construct($aliases)
	{
	
	}

	/**
	 * Retourne ou crée l'instance de la classe
	 *
	 * @param array $aliases
	 * @return \Core\Bracket\LoadAliasClass
	 */
	public static function getInstance($aliases)
	{
		if (is_null(self::$instance)) {

		}
	}
}
