<?php
/**
 * Created by PhpStorm.
 * @autor: Patric Petscher <contact@petschep.com>
 * Date: 16.11.16
 */

require_once('RequestModel.php');
require_once('RequestException.php');

class RequestFormView{

    public function render($data = null){
        $errors = array();
        try {
            $request = new RequestModel($data);

        }catch(RequestException $e){
            $errors = $e->getErrors();
            return $this->renderForm($data, $errors);
        }

        if($data == null){
            return $this->renderForm($data);
        } else {
            return $this->renderOk();
        }
    }

    public function renderOk(){
        ob_start();

        include('tpl/ok.tpl');

        $buffer = ob_get_contents();

        ob_end_clean();

        return $buffer;
    }

    public function renderForm($data, $errors = null){
        ob_start();

        include('tpl/header.tpl');
        include('tpl/form.php');
        include('tpl/footer.tpl');

        $buffer = ob_get_contents();

        ob_end_clean();

        return $buffer;
    }
}