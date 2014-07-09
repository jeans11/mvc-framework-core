<?php
namespace Core\Controller;

abstract class Controller
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

	/**
	 * Ajoute une ressource
	 */
	abstract protected function add();

	/**
	 * Met à jour une ressouce 
	 */
	abstract protected function update();

	/**
	 * Supprime une ressource
	 */
	abstract protected function delete();

	/**
	 * Affiche une ressource
	 */
	abstract protected function show();
}
