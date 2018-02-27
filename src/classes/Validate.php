<?php

class Validate{
	private $_passed = false,
			$_errors = [],
			$_db = null;

	public function __construct() {
		$this->_db = DB::getInstance();
	}

	public function check($source, $items = []) {
		foreach($items as $item => $rules) {
			foreach($rules as $rule => $rule_value) {
				$value = trim($source[$item]);
				$item = escape($item);

				if($rule === 'required' && empty($value)) {
					$this->addError("{$item} is required");
				}
				else if(!empty($value)) {
					switch ($rule) {
						case 'min':
							if(strlen($value) < $rule_value) {
								$this->addError("{$item} must be a minimum of {$rule_value} characters");
							}
							break;
						case 'max':
							if(strlen($value) > $rule_value) {
								$this->addError("{$item} must be a maximum of {$rule_value} characters");
							}
							break;
						case 'matches':
							if($value != $source[$rule_value]) {
								$this->addError("{$rule_value} must match {$item}");
							}
							break;
						case 'unique':
							$check = $this->_db->get($rule_value, [$item ,'=', $value]);
							if($check->count()) {
								$this->addError("{$item} already exists.");
							}
							break;
						case 'valid':
							if(!(filter_var($value, FILTER_VALIDATE_EMAIL))) {
								$this->addError("{$item} is invalid.");
							}
							break;
						case 'is_num':
							if(!(is_numeric($value))) {
								$this->addError("{$item} is invalid.");
							}
							break;
					}
				}
			}
		}
		if(empty($this->_errors)) {
			$this->_passed = true;
		}
		return $this;
	}


	private function addError($errors) {
		$this->_errors[] = $errors;
	}

	public function errors() {
		return $this->_errors;
	}

	public function passed() {
		return $this->_passed;
	}
}
