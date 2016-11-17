<?php
/**
 * Created by PhpStorm.
 * User: ansix
 * Date: 11.11.15
 * Time: 20:21
 */

error_reporting(0);
ini_set('display_errors', 0);
require_once('RequestFormView.php');

$form = new RequestFormView();

if($_GET || $_POST){
    if($_GET["submit"] == 1){
        echo $form->render($_GET);
    }
} else {

    echo $form->render();
}
