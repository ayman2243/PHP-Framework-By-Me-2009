<?php
/*
*  inputs class check form validation in one line
*  
*  return False or True
*    if(False) -> errors storied at static private $log
*    to analgize $log call static error function 
*    
* Inputs Filter Option ------------
* 
*   R -> required
* 	E -> email
* 	U -> url
* 	N -> name
*   S -> password
* 	D -> date
* 	B -> boolden
*   P -> ip
*   I -> int
*   T -> text
*   M -> match to values
*-----------------------------------
*  
*   by ayman elgohary
*/


interface InputBase{
	
	public function __construct();
	public function filter();
	
 //	static public function errors();
	
 //	private function FilterRequired();
    function FilterEmail();
    function FilterUrl($input, $option = NULL);
	function FilterName($input, $option = NULL);
	// private function FilterComment();
	function FilterDate($input, $option = NULL);
	function FilterBool($input, $option = NULL);
	function FilterIp($input, $option = NULL);
	function FilterInt($input, array $option = array());
	function FilterMatch(array $input, $option = NULL);
}

class input {
	
	public static $errors;
	private $log, $userinfo;
	private static $layout;
	
	// constructor switch layout errors
	public function __construct(array $WorkSpaceOption = NULL){
		
	  // do some thing here
		
	}
	
	public function FilterBool($input, $option = NULL){
		if(!filter_var($input, FILTER_VALIDATE_BOOLEAN)){
			return false;
		}else{
			return true;
		}
	}

	public function FilterInt($input, array $option = array()){
		if(!filter_var((int)$input, FILTER_VALIDATE_INT)){
			return false;
		}else{
			return true;
		}
	}
	
	public function FilterEmail($input, $option = NULL){
		if(!filter_var($input, FILTER_VALIDATE_EMAIL)){
			return false;
		}else{
		if(strlen($input) > 51){
				return false;
			}else{
				return true;
			}
		}
	}
	
	public function FilterUrl($input, $option = NULL){
		if(!filter_var($input, FILTER_VALIDATE_URL)){
			return false;
		}else{
		if(strlen($input) > 51){
				return false;
			}else{
				return true;
			}
		}
	}
	
	public function CheckChars($input){
		return strtr($input,'()*^%$#@!|\\][{},+','                 ');
	}
	
	public function FilterName($input, $option = NULL){
		if(filter_var($input, FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_AMP) != $input || strip_tags($input) != $input){
			return false;
		}else{
			if(strlen($input) > 51 || strlen($input) < 3){
				return false;
			}else{
				if($this->CheckChars($input) != $input){
					return false;
				}else{
					return true;
				}
			}
		}
	}
	
	public function FilterPassword($input, $option = NULL){
		if(filter_var($input, FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_AMP) != $input || strip_tags($input) != $input){
			return false;
		}else{
			if(strlen($input) > 21){
				return false;
			}else{
				if($this->CheckChars($input) != $input){
					return false;
				}else{
					return true;
				}
			}
		}
	}
	
	
	public function FilterDate($input, array $option = array()){
		if(!preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $input, $parts)){
			return false;
		}else{
			// don't forget to filter $option array as intger only
			$mini = (isset($option[0]) && $this->FilterInt($option[0]) != false) ? $option[0] : 1900;
			$max = (isset($option[1]) && $this->FilterInt($option[1]) != false) ? $option[1] : 2012;
			
		   if( ($parts[1] < $mini  || $parts[1] > $max) || ($parts[2] < 1 || $parts[2] > 13) 
		                  || ($parts[3] < 1 || $parts[3] > 31)){
			 return false;  
		   }else{
		   	 return true;
		   }
		}
	}
	
	public function FilterIp($input, $option = NULL){
		if(!filter_var($input, FILTER_VALIDATE_IP)){
			return false;
		}else{
			return true;
		}
	}
	
	public function FilterText($input, $option = NULL){
		
		if(is_array($input)){
			foreach ($input as $value):
				   if((strlen($input[0])) > ($input[1]+1)){
				   	 return false;
				   }else{
				   		return true;
				   }
		    endforeach;
		}else{
		   if(filter_var($input, FILTER_SANITIZE_STRING) != $input){
			  return false;
		 	}else{
			  return true;
		 	}
		}
	}
	
	public function FilterMatch(array $input, $option = NULL){
		if(!isset($input[0])  || !isset($input[1])){
			return false;
		}else if($input[0] == $input[1]){
			return true;
		}
	}
	
	
	public function filter(array $inputs){
		
	$this->log = '';
	
	foreach ($inputs as $k => $v):
	
	 $input = explode('-',$k);	 
	 $input[0] = strtoupper($input[0]);
	 
     if($v == NULL &&  substr($input[0],0,1) == 'R' && substr($input[0],1,2) != 'B' 
     //      || $v == false && substr($input[0],1,2) != 'B' && substr($input[0],0,1) == 'R' 
             || is_array($v) && substr($input[0],0,1) == 'R' && substr($input[0],1,2) == 'T' && $v[0] == NULL){
		 
		 $this->log.= "please fill out  ".$input[1]." filed. <br>";
     }else if( $v != NULL && substr($input[0],0) == 'E' || $v != NULL && substr($input[0],1) == 'E'){
	
	if(!$this->FilterEmail($v)){
		$this->log .= $input[1].' is not valid as  E-mail <br>';
	  }
	  	
    }else if($v != NULL && substr($input[0],0) == 'U' || $v != NULL && substr($input[0],1) == 'U'){
	
	if(!$this->FilterUrl($v)){
		$this->log .= $input[1].' is not valid as  url <br>';
	  }
    }else if($v != NULL && substr($input[0],0) == 'N' || $v != NULL && substr($input[0],1) == 'N'){
	
	if(!$this->FilterName($v)){
	  $this->log .= $input[1].' is not valid as  name must be letters and numbers only. <br>';
	}
    }else if($v != NULL && substr($input[0],0) == 'S' || $v != NULL && substr($input[0],1) == 'S'){
	
	if(!$this->FilterPassword($v)){
	  $this->log .= $input[1].' is not valid as  password <br>';
	}
    }else if($v != NULL && substr($input[0],0) == 'D' || $v != NULL && substr($input[0],1) == 'D'){
	
	if(!$this->FilterDate($v,array(1900,2012))){
		$this->log .= 'invalid date must be like 2000-12-31 <br>';
	}
    }else if($v != NULL && substr($input[0],0) == 'B' || $v != NULL && substr($input[0],1) == 'B'){
	
	if(!$this->FilterBool($v)){
	  $this->log.= $input[1].' is not valid as  boolean value <br>';
	}
	}else if($v != NULL && substr($input[0],0) == 'I' || $v != NULL && substr($input[0],1) == 'I'){
	
	$int_options = array("options"=> array("min_range"=>0, "max_range"=>256));
	
	if(!$this->FilterInt($v)){
	  $this->log .= $input[1].' '.$v.' is not valid as  intger value  <br>';
	}
	}else if($v != NULL && substr($input[0],0) == 'P' || $v != NULL && substr($input[0],1) == 'P'){
	
	if(!$this->FilterIp($v)){
	  $this->log .= $input[1].' is not valid as  ip address  <br>';
	}
	}else if($v != NULL && substr($input[0],0) == 'T' || $v != NULL && substr($input[0],1) == 'T'){
	
	if(!$this->FilterText($v)){
	  $this->log .= $input[1].' is not valid as  Text  <br>';
	}
	}else if(is_array($v) && substr($input[0],0) == 'M' || is_array($v) && substr($input[0],1) == 'M'){
	if(!$this->FilterMatch($v)){
		$this->log .=  $input[1].' <br>';
	}
	}
	
	endforeach;
	
	
	return ($this->log == NULL)? true: $this->log;
		
	}
	
	
}




?>