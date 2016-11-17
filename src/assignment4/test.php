<?php

require_once("validator.php");
require_once("validator_number.php");

$validator = new Validator_number();
echo $validator->check("Hallo");
echo $validator->errorMessage();
