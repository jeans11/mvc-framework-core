<?php
namespace Core\Controller;

abstract class Controller
{
	/**
	 * Ajoute une ressource
	 */
	abstract public function add();

	/**
	 * Met à jour une ressouce 
	 */
	abstract public function update();

	/**
	 * Supprime une ressource
	 */
	abstract public function delete();

	/**
	 * Affiche une ressource
	 */
	abstract public function show();
}
