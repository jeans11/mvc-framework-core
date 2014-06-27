<?php
namespace Core\Bracket\Traits;

trait ParseJsonTrait
{
	/**
	 * Parse un fichier json et 
	 * retourne un tableau PHP
	 *
	 * @param string $json
	 * @return array
	 */
	public function parseJson($json)
	{
		if (is_array($tab = json_decode(file_get_contents($json), true))) {
			return $tab;	
		}

		throw new ParseJsonException(ParseJsonException::SYNTHAXE_ERROR);
	}
}
