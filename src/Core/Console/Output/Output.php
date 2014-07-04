<?php
namespace Core\Console\Output;

abstract class Output
{
	/**
	 * Message à afficher
	 *
	 * @var string
	 */
	protected $msg;

	/**
	 * Crée une instance
	 *
	 * @param string $msg
	 * @return void
	 */
	public function __construct($msg)
	{
		$this->msg = $msg;	
	}

	/**
	 * Retourne le message avec la couleur
	 *
	 * @return string
	 */
	protected function decode()
	{
		return sprintf(static::getColor(),$this->msg);	
	}

	/**
	 * Convertion en chaine
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->decode();	
	}

	/**
	 * Retourne la couleur de la classe
	 * fille
	 *
	 * @return string
	 */
	abstract protected function getColor();
}
