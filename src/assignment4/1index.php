<?php
/**
 * Created by PhpStorm.
 * @autor: Patric Petscher <contact@petschep.com>
 * Date: 16.11.16
 */
require_once("RequestFormView.php");
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
  foreach ($_REQUEST as $item => $value){
    echo $item . ' => '.$value;
  }
}else{
// Collecting form components and combining them to variable to pass to final element wrap
  $components = "";
  $components .= $form->render('input','', array('type'=>'text','name'=>'arrival', 'placeholder'=>'Date DD.MM.YYYY'), true);
  //preparing options for select element
  $o = "";
  for ($i = 0; $i <= 30; $i++){
    $o .= $form->render('option', $i, array());
  }
  $components .= $form->render('select',$o, array('name'=>'nights'));
  $components .= $form->render('input','', array('type'=>'text','name'=>'name', 'placeholder'=>'string'), true);
  $components .= $form->render('input','', array('type'=>'email','name'=>'email', 'placeholder'=>'max@mustermann.at'), true);

  echo $form->render('form', $components, array('action'=> '', 'method'=> 'post'));
}

?>

</body>
</html>