<?php
/**
 * Simple validator class for numbers
 * 
 *
 */ 
class Validator_email extends Validator {
	protected $message;
	// returns true when OK, false when not OK.
	
	public function check($value) {
		if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
			$this->message = '\''.$value.'\' is not an email';
			return false;
		}
		else {
			$this->message = "";
			return true;
		}
	}
}