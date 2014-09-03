<?php
namespace Core\Validation;

interface ValidationInterface
{
	/**
	 * Régles appliquées aux champs
	 * 
	 * @return array
	 */
	public function rules();

	/**
	 * Messages d'erreurs si les
	 * champs de respectent pas
	 * les règles
	 *
	 * @return array
	 */
	public function messages();
}
