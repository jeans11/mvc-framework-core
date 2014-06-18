<?php
namespace Core\Bracket\RegEx;

class RegExString
{
	/**
	 * Retourne l'expression régulière
	 *
	 * @return string
	 */
	public function __toString()
	{
		return '[a-zA-Z]*';
	}
}
