<?php
/**
 * Created by PhpStorm.
 * @autor: Patric Petscher <contact@petschep.com>
 * Date: 16.11.16
 */
class RequestException extends Exception{
    private $errors;

    public function __construct($message, $errors){
        $this->setErrors($errors);
    }

    public function setErrors($errors){
        $this->errors = $errors;
    }

    public function getErrors(){
        return $this->errors;
    }

}