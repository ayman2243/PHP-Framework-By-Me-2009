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


class basic{
	
	
	public static $basefolder = ".";
	
	public function view($template,$data=NULL,array $basicdata=NULL){
		
		if(is_array($data)){ extract($data); }
		
	    if(is_array($basicdata)){ extract($basicdata); }
		
		if(@file_exists(self::$basefolder.'/'.$template))
		{
			include (self::$basefolder.'/'.$template);
		}
		else if(@file_exists(self::$basefolder.'/'.$template.'.tp.php'))
		{	
			include (self::$basefolder.'/'.$template.'.tp.php');		
		}
		else
		{	
			throw  new Exception('incorrect file name => '.$template.' can\'t found in themes folder');		
		}
	 	
	}
	
}

?>