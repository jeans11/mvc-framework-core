<?php
namespace Core\Bracket\RegEx;

class RegExInteger
{
	/**
	 * Retourne l'expression régulière
	 *
	 * @return string
	 */
	public function __toString()
	{
		return '[0-9]*';
	}
}
