<?php
namespace Core\Config;

use SplSubject;
use SplObserver;

class Environment implements SplSubject
{
	/**
	 * L'environnement de lancement
	 *
	 * @var string
	 */
	private static $env;	

	/**
	 * Observers
	 *
	 * @var array
	 */
	private static $observers = array();

	/**
	 * Modifie l'environnement de lancement
	 *
	 * @param array $args
	 * @return void
	 */
	private function setEnv($args)
	{
		if (empty($args)) {
			static::$env = 'http';
		} else {
			static::$env = 'console';
		}
	}

	/**
	 * Répand l'environnement
	 * de lancement
	 */
	public function spill()
	{
		$this->notify();	
	}

	public function getEnv()
	{
		return static::$env;	
	}

	/**
	 * Ajoute un observateur
	 *
	 * @param SplObserver $observer
	 * @return void
	 */
	public function attach(SplObserver $observer)
	{
		static::$observers[] = $observer;
	}

	/**
	 * Supprime un observateur
	 * @param SplObserver $observer
	 * @return void
	 */
	public function detach(SplObserver $observer)
	{
		unset(static::$observer[$observer]);
	}

	/**
	 * Notifie les observateurs
	 *
	 * @return void
	 */
	public function notify()
	{
		foreach (static::$observers as $observer) {
			$observer->update($this);
		}
	}
}
