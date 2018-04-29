<?php

namespace validator;

class ValidatorErrors
{
	private $errors = [];

	public function errorsMessages()
	{
		return [
			'integer' => 'Value should be an integer.',
			'required' => 'Field can not be empty.', 
		];
	}

	public function get($field = null)
	{
		if ($field === null)
			return $this->errors;

		if (array_key_exists($field, $this->errors))
			return $this->errors[$field];
		else 
			return null;
	}

	public function add($args)
	{
		if (count($args) <= 0) return false;
	
		foreach ($args as $key => $value) {
			
			$this->errors[$key] = $value;
		
		}
	}

}