<?php
/**
 * Simple validator class for numbers
 * 
 *
 */ 
class Validator_string extends Validator {
	protected $message;
	// returns true when OK, false when not OK.
	
	public function check($value) {
		if (preg_match("/<[^<]+>/",$value,$m) != 0 || empty($value)) {
			$this->message = '\''. htmlentities($value) .'\' is not a string';
			return false;
		}
		else {
			$this->message = "";
			return true;
		}
	}
}