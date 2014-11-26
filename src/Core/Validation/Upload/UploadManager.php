<?php
namespace Core\Validation\Upload;

use \Upload\File;
use \Upload\Validation\MimeType;
use \Exception;

class UploadManager
{
	private $file;

	private $accepts;

	private $errors;

	public function __construct(File $file, $accepts)
	{
		$this->file    = $file;
		$this->accepts = $accepts;

		$this->init();
	}

	public function success()
	{
		try {
			$this->file->upload();	
			return true;
		}	catch (Exception $e) {
			return false;
		}
	}

	public function errors()
	{
		return $this->file->getErrors();	
	}

	private function init()
	{
		$this->file->addValidations(array(
			$this->accepts	
		));
	}
}
