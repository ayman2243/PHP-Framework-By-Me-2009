<?php

interface Myfilter{
	public function input();
	public function output();
}

class filter2 implements Myfilter{
	
	public $input_types = array(
	                     'username' => array('<','/','>','&','*','^','%','$','#','@','!',')','(','[',']','}','{','+',':',';','"',"'",'\\',' '),
	                     'email' => array('<','/','>','&','*','^','%','$','#','!',')','(','[',']','}','{',':',';','"',"'",'\\',' '),
	                     'date' => array('<','>','&','*','^','%','$','#','@','!',')','(','[',']','}','{','+',':',';','"',"'",' '),
	                     'url' => array('<','/','>','&','*','^','%','$','#','@','!',')','(','[',']','}','{','+',':',';','"',"'",'\\'),
	                     'string' => array('<','/','>','&','*','^','%','$','#','@','!',')','(','[',']','}','{','+',':',';','"',"'",'\\','0','1','2','3','4','5','6','7','8','9'),
	                     'int' => array('<','/','>','&','*','^','%','$','#','@','!',')','(','[',']','}','{','+',':',';','"',"'",'\\')
	                           );
	 private $errors ;

	 public function input(array $inputs){
	 	
	 	foreach ($inputs as $key => $value):
	 	   if(in_array($key, array_keys($this->input_types))){
	 	   	
	 	   	   $value = str_replace($this->input_types[$key], ' ', $value);
	 	   	   
	 	   	   $value = explode(' ', $value);
	 	   	   
	 	   	   $value = implode('', $value);
	 	   	   
	 	   	   $inputs[$key] = $value;
	 	   }
	 	endforeach;
	 	
	 	return $inputs;
	 	
	 }
	 
	 public function output(){
	 	
	 }
	
}

?>