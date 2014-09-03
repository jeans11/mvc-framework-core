<?php
namespace Core\Validation;

interface ValidationInterface
{
	public function rules();

	public function messages();
}
