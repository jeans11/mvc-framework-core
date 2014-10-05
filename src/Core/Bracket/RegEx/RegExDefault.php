<?php
namespace Core\Bracket\RegEx;

class RegExDefault
{
	/**
	 * Retourne l'expression régulière
	 *
	 * @return string
	 */
	public function __toString()
	{
		return '[a-zA-Z0-9]*';
	}
}
