<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modellain extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}
	
	//Generate Random Digit
	function genRndDgt($length = 8,$specialCharacters = true){
		$digits = '';
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ23456789";
		
		if($specialCharacters === true)
			$chars .= "!?=/&+,.";
		
		for($i = 0; $i<$length; $i++){
			$x = mt_rand(0, strlen($chars)-1);
			$digits .= $chars{$x};
		}
		
		return $digits;
	}
	
}