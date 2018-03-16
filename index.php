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

 //Set a namespace

//namespace GomadoFrameWork;

 //Start defining Constants ...

define('GOMADO_VERSION', 'beta');

define('ENVIRONMENT', 'development');

define('DEVELOPER', 'Ayman Elgohary');

define('AUTHOR', DEVELOPER);

define('BASEPATCH', str_replace('\\','/',dirname(__FILE__)).'/');

define('BASEURL', 'http://'.$_SERVER['HTTP_HOST'].str_replace("index.php", "", $_SERVER['SCRIPT_NAME'])."");

define('SYSROOT', BASEPATCH.'/system/');

define('APPROOT', BASEPATCH.'/app/');

define('EXT', '.php');

define('CEXT', '.class.php');

define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

// End defining Constants ...

switch(is_dir(BASEPATCH)){
	case 1:
		break;
	default:
		die(trigger_error('<a href="#">Your base path does not appear to be set correctly.</a> Please correct it ',E_USER_WARNING));
		break;	
}

################################################ Protection aginst Session Injection #############################################################

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
  
  //setcookie("GomadoSesID".substr(md5($val),0,10),session_id(),time()+60*60*24*30);  for remmber me login set to month
  
################################################################################################################################################  

$indexPage =& $_GET['site'];

// Change 'blog/view' in the next line to your main controller

$indexPage = (!isset($indexPage) || (isset($indexPage) && $indexPage == NULL)) ? 'beta/index' : trim(strtolower($indexPage));

require_once SYSROOT.'core/connectors'.EXT;


/*
 *  End of index.php
 *  Location: BASEPATCH.'index.php' ;
 */

?>