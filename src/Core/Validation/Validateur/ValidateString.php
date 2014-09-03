<?php
namespace Core\Validation\Validateur;

class ValidateString implements InterfaceValidateur
{
	public static function isValid($value)
	{
		return ctype_alpha($value);
	}
}
