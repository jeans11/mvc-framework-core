<?php
namespace Core\Form;

use PFBC\Form;
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
		
		$this->addToForm($elements);

		return $this->form;
	}

	private function addToForm($elements)
	{
		foreach ($elements as $element) {
			$this->form->addElement($this->getInstanceElement($element));
		}
	}

	private function getInstanceElement($element)
	{
		$class = 'PFBC\\Element\\'.ucfirst($element['type']);
		return new $class(
			$element['label'],
			$element['name']
		);
	}
}
