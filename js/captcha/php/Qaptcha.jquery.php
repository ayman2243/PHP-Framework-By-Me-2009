<?php
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

  
  
$aResponse['error'] = false;
$_SESSION['iQaptcha'] = false;	
	
if(isset($_POST['action']))
{
	if(htmlentities($_POST['action'], ENT_QUOTES, 'UTF-8') == 'qaptcha')
	{
		$_SESSION['iQaptcha'] = true;
		if($_SESSION['iQaptcha'])
			echo json_encode($aResponse);
		else
		{
			$aResponse['error'] = true;
			echo json_encode($aResponse);
		}
	}
	else
	{
		$aResponse['error'] = true;
		echo json_encode($aResponse);
	}
}
else
{
	$aResponse['error'] = true;
	echo json_encode($aResponse);
}