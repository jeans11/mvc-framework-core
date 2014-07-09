<?php
namespace Core\Manager;

abstract class Manager
{
	/**
	 * Référence à EntityManager
	 */
	protected static $entityManager;

	/**
	 * Modification de EntityManager
	 *
	 * @param EntityManager
	 * @return void
	 */
	public static function setEntityManager($value)
	{
		static::$entityManager = $value;	
	}

	/**
	 * Retourne EntityManager
	 *
	 * @return EntityManager
	 */
	protected function getEntityManager()
	{
		return static::$entityManager;	
	}

	abstract public function add();
}
