<?php

/*
 *  Gomado FrameWork is A beta version  only for test
 *  
 *   Develop by Ayman Elgohary -> ayman2243@gmail.com
 *   
 *   website: gomado.com
 *   
 *   phone: +20121207245
 * 
 */



class upload_functions{
	private $fpatch;
	
	public function __construct($fpatch){
		$this->fpatch = $fpatch;
	}
	public function info(){
		return scandir($this->fpatch);
	}
}


?>