<?php
namespace Core\Form;

use PFBC\Form;
use PFBC\Element;
use Core\Form\FormElementsInterface;

class FormBuilder
{
	private $form;

	public function __construct(Form $form)
	{
		$this->form = $form;	
	}

	public function create($action, $id, $elements, $method = 'POST')
	{
		$this->form->configure(array(
			'action' => $action,
			'id' => $id,
			'method' => $method
		));
		
		$this->addToFrom($elements);

		return $this->form;
	}

	private addToForm($elements)
	{
		foreach ($elements as $class => $options) {
			$this->form->addElement($this->getInstanceElement($class, $options));
		}
	}

	private function getInstanceElement($class, $options)
	{
		return new 'Element\\'.ucfirst($class)($options[0], $options[1]);
	}
}
