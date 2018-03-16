<?php
  class keymaker{

  	public $name,$length;
  	
  	 public function key($name,$length = 100){
  		
  		$new_key = $this->RoundString($length);
  		$_SESSION[$name] = $new_key;
  		return $new_key;
  	}
  	
  	 private function RoundString($large){
  		$length = $large;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzQWERTYUIOPLKJHGFDSAZXCVBNM';
        $string = "";    

        for ($p = 0; $p < $length; $p++) {
          	//disable notice errors for this action...
        	error_reporting(0);
            
          	$string .= $characters[mt_rand(0, strlen($characters))];
            
          	error_reporting(E_ALL);
        }
        return $string;
  	}
  	
  }
?>