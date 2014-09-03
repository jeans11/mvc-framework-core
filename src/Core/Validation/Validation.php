<?php
namespace Core\Validation;

use Core\Validation\ValidationInterface;

class Validation
{
	/**
	 * Contient les erreurs
	 *
	 * @param array
	 */
	private $errors = array();

	/**
	 * Contient les règles à appliqué
	 * aux champs
	 *
	 * @param array
	 */
	private $rules = array();

	/**
	 * Contient les messages à utiliser
	 * en cas d'erreur
	 *
	 * @param array
	 */
	private $messages = array();

	/**
	 * Vérifie les champs et enregistre les erreurs
	 * s'il y en a
	 *
	 * @param  array                               $inputs
	 * @param  Core\Validation\ValidationInterface $entity
	 * @return Core\Validation\Validation 
	 */
	public function validate($inputs, ValidationInterface $entity)
	{
		$this->rules = $entity->rules();	
		$this->messages = $entity->messages();

		foreach ($this->rules as $name => $rule) {
			$rule = $this->extractRules($rule);
			
			$this->hydrate($rule, $name, $inputs[$name]);
		}
		return $this;
	}

	/**
	 * Vérifie s'il y a des erreurs
	 *
	 * @return boolean
	 */
	public function isValid()
	{
		return empty($this->errors);
	}

	/**
	 * Extrait les régles pour un champs
	 *
	 * @param string $rule
	 * @return array
	 */
	private function extractRules($rule)
	{
		return explode(';', $rule);
	}

	/**
	 * Appelle les validateurs suivant les
	 * règles définit et enregistre les erreurs
	 *
	 * @param array	 $rules
	 * @param string $name
	 * @param sring  $value
	 * @return void
	 */
	private function hydrate($rules, $name, $value)
	{
		foreach ($rules as $rule) {
			$class = "Core\Validation\Validateur\Validate".ucfirst($rule);
			$r = $class::isValid($value);

			if (!$r) {
				$this->errors[] = $this->messages[$name];
				break;
			}
		}
	}

}
