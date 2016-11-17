<?php
/**
 * Created by PhpStorm.
 * @autor: Patric Petscher <contact@petschep.com>
 * Date: 16.11.16
 */
require_once("RequestFormView.php");
require_once("RequestException.php");
require_once("RequestModel.php.php");
$form = new RequestFormView();

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Webtech 4</title>
</head>
<body>

<?php
if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 1){
  $errors = array();
  try {
    $request = new RequestModel($data);

  }catch(RequestException $e){
    $errors = $e->getErrors();
    return $this->renderForm($data, $errors);
  }

}else{
// Collecting form components and combining them to variable to pass to final element wrap
  echo $form->render('h1','1.2 Form Webtech', array());
  $components = "";
  $components .= $form->render('input','', array('type'=>'text','name'=>'arrival', 'placeholder'=>'Date DD.MM.YYYY'), true);
  $components .= $form->render('br','', array(), true);
  //preparing options for select element
  $o = "";
  for ($i = 0; $i <= 30; $i++){
    $o .= $form->render('option', $i, array());
  }
  $components .= $form->render('select',$o, array('name'=>'nights'));
  $components .= $form->render('br','', array(), true);
  $components .= $form->render('input','', array('type'=>'text','name'=>'name', 'placeholder'=>'string'), true);
  $components .= $form->render('br','', array(), true);
  $components .= $form->render('input','', array('type'=>'email','name'=>'email', 'placeholder'=>'max@mustermann.at'), true);
  $components .= $form->render('br','', array(), true);
  $components .= $form->render('input','', array('type'=>'hidden','name'=>'submit', 'value'=>1), true);
  $components .= $form->render('button','Senden', array('type'=>'submit') );

  echo $form->render('form', $components, array('action'=> '', 'method'=> 'post'));
}

?>

</body>
</html>