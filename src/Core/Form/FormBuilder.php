<?php
namespace Core\Form;

use PFBC\Form;
use Core\Form\FormElementsInterface;

class FormBuilder
{
	/**
	 * Instance du Formuliare
	 *
	 * @var PFBC\Form;
	 */
	private $form;

	/**
	 * Crée une nouvelle instance
	 *
	 * @param PFBC\Form
	 * @return void
	 */
	public function __construct(Form $form)
	{
		$this->form = $form;	
	}

	/**
	 * Création du formulaire et ajout des champs
	 * @param string $action
	 * @param string $id
	 * @param array  $elements
	 * @param string $method
	 * @return PFBC\Form
	 */
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

	/**
	 * Ajoute des élements au
	 * formulaire
	 *
	 * @param array $elements
	 * @return void
	 */
	private function addToForm($elements)
	{
		foreach ($elements as $element) {
			$this->form->addElement($this->getInstanceElement($element));
		}
	}

	/**
	 * Retourne une instance de l'élement
	 *
	 * @param array $element
	 * @return mixed
	 */
	private function getInstanceElement($element)
	{
		$class = 'PFBC\\Element\\'.ucfirst($element['type']);

		switch ($element['type']) {
			case 'checkbox':
				return new $class(
					$element['label'],
					$element['name'],
					$element['options']
				);
				break;
			default:
				return new $class(
					$element['label'],
					$element['name']
				);
				break;
		}
	}
}
