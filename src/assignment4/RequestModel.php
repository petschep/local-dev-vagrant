<?php
/**
 * Created by PhpStorm.
 * @autor: Patric Petscher <contact@petschep.com>
 * Date: 16.11.16
 */

require_once("Validator/validator.php");
require_once("Validator/validator_number.php");
require_once("Validator/validator_integer.php");
require_once("Validator/validator_date.php");
require_once("Validator/validator_email.php");
require_once("Validator/validator_string.php");
require_once("RequestException.php");


class RequestModel{
    private $arrival;
    private $nights;
    private $name;
    private $email;

    public function __construct($data){
        $errors = array();

        foreach($data as $key => $value){
            if($key != 'submit'){
                try{
                    $methodName = 'set'.ucfirst($key);
                    $this->$methodName($value);
                }catch (Exception $e){
                    $errors[$key] = $e->getMessage();
                }
            }
        }
        /*
        if($_POST){
            if($_POST['arrival']){
                try{
                    $this->setArrival($_POST['arrival']);
                }catch (Exception $e){
                    $errors['arrival'] = $e->getMessage();
                }
            }
            if($_POST['nights']){
                try{
                    $this->setNights($_POST['nights']);
                }catch (Exception $e){
                    $errors['nights'] = $e->getMessage();
                }
            }
            if($_POST['name']){
                try{
                    $this->setName($_POST['name']);
                }catch (Exception $e){
                    $errors['name'] = $e->getMessage();
                }
            }
            if($_POST['email']){
                try{
                    $this->setEmail($_POST['email']);
                }catch (Exception $e){
                    $errors['email'] = $e->getMessage();
                }
            }
        }
        */

        if(count($errors) > 0){
            throw new RequestException("Errors", $errors);
        }
    }

    public function getArrival(){
        return $this->arrival;
    }

    public function setArrival($arrival){
        $validator = new Validator_date();

        if($validator->check($arrival)){
            $this->arrival = $arrival;
        }else{
            throw new Exception($validator->errorMessage());
        }
    }

    public function getNights(){
        return $this->nights;
    }

    public function setNights($nights){
        $validator = new Validator_integer();

        if($validator->check($nights)){
            $this->nights = $nights;
        }else{
            throw new Exception($validator->errorMessage());
        }
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $validator = new Validator_string();

        if($validator->check($name)){
            $this->name = $name;
        }else{
            throw new Exception($validator->errorMessage());
        }
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $validator = new Validator_email();

        if($validator->check($email)){
            $this->email = $email;
        }else{
            throw new Exception($validator->errorMessage());
        }
    }

}