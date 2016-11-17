<?php
/**
 * Created by PhpStorm.
 * @autor: Patric Petscher <petschep@gmail.com>
 * Date: 16.11.16
 */

class RequestFormView {

  /**
   * @param      $element
   * @param      $args
   * @param bool $singleClosing
   */
  public function render($element, $content, $args, $singleClosing = false){
	try{
	  return $this->buildElement($element, $content, $args, $singleClosing);
	}catch (Exception $exception){
	  echo $exception;
	}

  }

  /**
   * @param $element
   * @param $this
   */
  private function buildElement($element, $content, $args, $singleClosing){
	$tmp = '';
	$attributes = $this->buildArguments( $args);
	if($singleClosing){
		$tmp = '<'.$element. ' '.$attributes.'/>';
	}else{
		$tmp = '<'.$element. ' '.$attributes.'>'.$content.'</'.$element.'>';
	}
	return $tmp;
  }



  /**
   * @param array $args
   * @return string
   */
  private function buildArguments(array $args){
	//define temporary variable for return String
	$tmp = "";
	foreach ($args as $arg => $value){
	  $tmp .= $arg.'="'.$value.'" ';
	}
	return $tmp;
  }
}
