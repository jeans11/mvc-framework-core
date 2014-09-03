<?php
namespace Core\Validation\Validateur;

class ValidateString implements ValidateurInterface
{
	public static function isValid($value)
	{
		return ctype_alpha($value);
	}
}
