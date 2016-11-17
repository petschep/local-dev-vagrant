<?php
/**
 * Simple validator class for numbers
 * 
 *
 */ 
class Validator_date extends Validator {
	protected $message;
	// returns true when OK, false when not OK.
	
	public function check($value) {
		preg_match("/\d{1,2}\.\d{1,2}\.\d{4}/", $value, $matches);
		if (count($matches) == 0 || count($value) == 0) {
			$this->message = '\''.$value.'\' is not a date';
			return false;
		}
		else {
			$this->message = "";
			return true;
		}
	}
}