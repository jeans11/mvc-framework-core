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
	 * Tableau des aliases
	 *
	 * @var array
	 */
	private $aliases;

	/**
	 * Chargeur enregistré
	 *
	 * @var boolean
	 */
	private $checked = false;

	/**
	 * Crée un nouvelle instance
	 *
	 * @param array $aliases
	 * @return void
	 */
	public function __construct($aliases = array())
	{
		$this->aliases = $this->setAlias($aliases);	
	}

	/**
	 * Retourne ou crée l'instance de la classe
	 *
	 * @param array $aliases
	 * @return \Core\Bracket\LoadAliasClass
	 */
	public static function getInstance($aliases = array())
	{
		if (is_null(static::$instance)) {
			static::$instance = new self($aliases);
		}
		return static::$instance;
	}

	/**
	 * Recherche la classe et créé l'alias 
	 *
	 * @param string $alias
	 * @return void
	 */
	public function loader($alias)
	{
		if (isset($this->aliases[$alias])) {
			return class_alias($this->aliases[$alias], $alias);
		}
	}

	/**
	 * Informe la pile d'autoload de charger la
	 * function loader
	 *
	 * @return void
	 */
	private function addToAutoload()
	{
		spl_autoload_register(array($this,'loader'), true, true);
	}

	/**
	 * Enregistre les alias
	 *
	 * @return void
	 */
	public function check()
	{
		if (!$this->checked) {
			$this->addToAutoload();	
			$this->checked = true;
		}
	}

	/**
	 * Modifie le tableau des alias
	 *
	 * @param array $aliases
	 * @return array $return
	 */
	private function setAlias($aliases)
	{
		$return = array();
		foreach ($aliases as $className => $alias) {
			$return[$alias['aliasClassName']] = $className;
		}
		return $return;
	}
}
