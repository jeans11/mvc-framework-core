<?php
namespace Core\Validation\Validateur;

interface ValidateurInterface
{
	/**
	 * Vérifie la valeur suivant la règle
	 * utilisé
	 */
	public static function isValid($value);
}
