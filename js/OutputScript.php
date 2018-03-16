<?php

//start session like framework started

$val[] = $_SERVER['HTTP_USER_AGENT'];
 $val[] = $_SERVER['REMOTE_ADDR'];
 $val[] = date("Y-m");
 $val = implode("#%$",$val);	
 
 define("SSNAME","GomadoSesID".substr(md5($val),0,10));

 session_name(SSNAME);
 session_start(); 
 
 
  if(!isset($_SESSION[$val]) || $_SESSION[$val] != md5($val)){
	  
	   session_unset();
	
	   session_regenerate_id();

	   $_SESSION[$val] = md5($val); 
  }
  
//__________________________________________________________________________________________________________________  



if(!isset($_GET['cfid']) || $_GET['cfid'] == null || !isset($_SESSION['JScodeOutput']) || !isset($_SESSION['JScodeOutput'][$_GET['cfid']]))
{
	//blank page
}
else 
{
	Header("content-type: application/x-javascript");
	
print '/*
 * jQuery Output Script @ Gomado FrameWork 
 *
 * Date: '.date("l dS \of F Y h:i:s A").'
 *
 * Gomado FrameWork is A beta version  only for test
 *  
 * Develop by Ayman Elgohary -> ayman2243@gmail.com
 *   
 * website: gomado.com
 *   
 * phone: +20121207245
 * 
 */
 '."\n\n";
	
	print $_SESSION['JScodeOutput'][$_GET['cfid']];
}



