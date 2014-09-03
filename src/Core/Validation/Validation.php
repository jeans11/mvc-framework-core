<?php
namespace Core\Validation;

use Core\Validation\ValidationInterface;

class Validation
{
	private $errors = array();

	public function validate($inputs, ValidationInterface $entity)
	{
		$rules = $entity->rules();	
		$messages = $entity->messages();

		foreach ($rules as $name => $rule) {
			$rule = $this->extractRules($rule);

			foreach ($rule as $dummy) {
				$class = "Core\Validation\Validateur\Validate".ucfirst($dummy);
				$r = $class::isValid($inputs[$name]);

				if (!$r) {
					$this->errors[] = $message[$name];
					break;
				}
			}
		}

		return $this;
	}

	public function isValid()
	{
		return empty($this->errors);
	}

	private function extractRules($rule)
	{
		return explode(';', $rule);
	}

}
