<?php

namespace validator;

use validator\ValidatorErrors;

class Validator
{
	private $validatorErrors;
	private $errorsMessages;
	private $field;

	public function __construct()
	{
		$this->validatorErrors = new ValidatorErrors();
		$this->errorsMessages = $this->validatorErrors->errorsMessages();
	}

	public function getErrorMessage($key)
	{
		return $this->errorsMessages[$key];
	}

	public function getError($field)
	{
		return $this->validatorErrors->get($field);
	}

	public function getErrors()
	{
		return $this->validatorErrors->get();
	}

	public function isValidationErrors()
	{
		if (count($this->validatorErrors->get()) > 0) return true; 
	}

	public function validate($data, $args)
	{
		$this->field = $args['field'];

		$method = 'validate' . ucfirst($args['method']);
		return $this->$method($data);
	}

	private function validateInteger($data)
	{

		if (is_numeric($data)) return true;
		else $this->validatorErrors->add([$this->field => $this->getErrorMessage('integer')]);
		
	}

	private function validateRequired($data)
	{

		if ($data != "" && $data !== null) return true;
		else $this->validatorErrors->add([$this->field => $this->getErrorMessage('required')]);
	}
}