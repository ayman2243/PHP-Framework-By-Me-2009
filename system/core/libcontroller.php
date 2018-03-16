<?php
class Lib_Controller{

    public function __construct(){	
	// define the __autoload function 	
	//   spl_autoload_register('Cloader');
	//	$this->load = new basic;		
	}
	
	// public function load($Class){
	//	return Cloader($Class);	
	// }
	
	public function __get($Classname){
	//	return new $Classname;
	}

}
?>