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

function myException($exception)
{
	//db-\>select\('comment'\)
	$getTraceAsString = $exception->getTraceAsString();
	$getTraceAsString = str_replace('#2 D:\xampp\htdocs\gomado3\system\hooks\hook1.php(35): Hook::CheckThisReq(Array)'."\n", '', $getTraceAsString);
	$getTraceAsString = str_replace('#3 D:\xampp\htdocs\gomado3\system\core\connectors.php(127): Hook::HookThisReq(Array)'."\n", '', $getTraceAsString);
	$getTraceAsString = str_replace('#4 D:\xampp\htdocs\gomado3\index.php(83): require_once(\'D:\xampp\htdocs...\')'."\n", '', $getTraceAsString);
	$getTraceAsString = str_replace('#5 {main}', '', $getTraceAsString);
	$getTraceAsString = preg_replace("/(([A-Za-z0-9]+->[A-Za-z0-9]+)\(['|]([A-Za-z0-9]+)['|]\))/",'<b>$2(\'<b style="color:#F03;">$3</b>\')</b>',$getTraceAsString);
	$getTraceAsString = preg_replace("/(->[a-z0-9]+\(\))/",'<b>$1</b>',$getTraceAsString);
	$getTraceAsString = preg_replace("/(app\\\controller\\\([a-zA-Z0-9.]+))/",'<span style="color:#090; border:dashed 1px #600; background:#FFF; font-weight:bold; padding: 0 2px 0 2px;">$1</span>',$getTraceAsString);
	print '<!DOCTYPE HTML><html><head><style type="text/css">body {background-color: #333;} 
	div.main{outline:none; transition: all 0.25s ease-in-out; -webkit-transition: all 0.25s ease-in-out; -moz-transition: all 0.25s ease-in-out; 
	border-radius:5px; -webkit-border-radius:5px; -moz-border-radius:5px; border:1px solid rgba(0,0,0, 0.2); 
	 box-shadow: 0 0 10px rgba(35, 35, 35, 1); -webkit-box-shadow: 0 0 10px rgba(35,35, 35, 1); -moz-box-shadow: 0 0 10px rgba(35, 35, 35, 1); border:1px solid rgba(35,35,35, 0.8);}</style></head><body><br><br><div class="main" style="margin:0 auto; width:40%; overflow:auto; background:#FFFF9D; font-family:Tahoma; font-size:12px; padding:20px 10px 20px 20px;  ">';
	print '<strong>Error Exception</strong>: <span style="color:#03F">'.$exception->getMessage().'</span><br>';
	print '<div style="padding:2px; "></div>';
	print nl2br($getTraceAsString);
	print '<br>Gomado Error Exception -> core -> MyException.php';
	print '</div></body>';
}

set_exception_handler('myException');
?>