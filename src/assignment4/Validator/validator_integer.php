<?php
/**
 * Simple validator class for integers
 * 
 *
 */ 
class Validator_integer extends Validator {
	protected $message;
	// returns true when OK, false when not OK.
	
	public function check($value) {
		if (!preg_match('/^[0-9]*$/',$value,$m) != 0) {
			$this->message = '\''.$value.'\' is not an integer';
			return false;
		}
		else {
			$this->message = "";
			return true;
		}
	}
}