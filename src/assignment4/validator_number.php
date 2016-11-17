<?php
/**
 * Simple validator class for numbers
 * 
 *
 */ 
class Validator_number extends Validator {
	protected $message;
	// returns true when OK, false when not OK.
	
	public function check($value) {
		if (!is_numeric($value)) {
			$this->message = '\''.$value.'\' is not a number';
			return false;
		}
		else {
			$this->message = "";
			return true;
		}
	}
}