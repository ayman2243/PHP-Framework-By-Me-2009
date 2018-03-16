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
 *   start controller
 */


class Controller{
	
	public $load;
	
	public function __construct(){
		
	// define the __autoload function 
		
		spl_autoload_register('Cloader');
		
		$this->load = new basic;
		
	}
	
	/*public function load($Class){
		
		return Cloader($Class);
		
	}*/
	
	public function __get($Classname){
		
		return new $Classname;
		
	}
	
	
}


/*
 * End of controller 
 * 
 * Notic : still underconstruction
 * 
 * location : system/core/controller.php
 */
?>