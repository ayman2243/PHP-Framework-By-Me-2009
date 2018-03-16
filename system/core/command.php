<?php

function Cloader($ClassName){
	   
	if(@file_exists(SYSROOT.'lib/php/'.$ClassName.CEXT)){
		
		include_once (SYSROOT.'lib/'.'php/'.$ClassName.CEXT);
   
        return new $ClassName;

	}else if(@file_exists(SYSROOT.'lib/html/'.$ClassName.CEXT)){
		
		include_once (SYSROOT.'lib/'.'html/'.$ClassName.CEXT);
   
        return new $ClassName;
		
	}else if(@file_exists(SYSROOT.'lib/javascript/'.$ClassName.CEXT)){
		
		include_once (SYSROOT.'lib/'.'javascript/'.$ClassName.CEXT);
   
        return new $ClassName;
		
	}else if(@file_exists(SYSROOT.'lib/ajax/'.$ClassName.CEXT)){
		
		include_once (SYSROOT.'lib/'.'ajax/'.$ClassName.CEXT);
   
        return new $ClassName;
		
	}else if(@file_exists(APPROOT.'models/'.$ClassName.EXT)){
		
		include_once (APPROOT.'models/'.$ClassName.EXT);
   
        return new $ClassName;
		
	}else{
		
		throw new Exception('System Class {'.$ClassName.'} not found in our lib');
	}
	
   
}

function error404($error=NULL){
	
	header('HTTP/1.1 404 Not Found');
	
	set_include_path(APPROOT);
		
	$error = ($error ==NULL)? 'Please check your request '.$_SERVER['REQUEST_URI'] :$error;
		
	include_once APPROOT.'errors/error-404'.EXT;
		
}

function callback($buffer)
{
	
  $lang = include ('app/lang/ar_EG.php');
	
  return (str_replace(array_keys($lang['lang']), $lang['lang'], $buffer));
  // replace all the apples with oranges
  // return (str_replace("{Test}", "Note : Changed by ob_start(callback)", $buffer));
}



?>