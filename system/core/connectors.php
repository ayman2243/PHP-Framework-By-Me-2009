<?php
/*
 * Developed by Ayman Elgohary Phone +20121207245
 *    
 *     Beta Version 
 *     
 *     ayman2243@gmail.com
 *     
 * ####################################################
 *
 * connectors can repair url requests 
 *  Ex:
 *     index///blog///////view/////\\\\ = index/blog/view = index?site=blog/view
 *     
 * #####################################################
 * 
 * index.php = index = index/?site={defulat page}
 * 
 * index?site=* = index/* 
 * 
 * index.php/blog = index/blog
 * 
 * index/?site=blog
 * 
 * index/?site=blog{Controller class}/view{Controller method}
 * 
 */

require_once SYSROOT.'core/command'.EXT;

/*
 * this function below repair $_GET['site'] and return to true call
 * 
 * only made for $_GET['site']
 * 
 * not profissnol but so easy
 * 
 */
function connector1(){

	if(isset($_GET['site']) && $_GET['site'] != NULL){
		
		// splite $_GET['site'] to array by / slash
		
		$requst = explode('/',str_replace('</','<',trim(strtolower($_GET['site']))));
		
		// remove nulled items
		
		foreach ($requst as $k => $v){
			
			if(isset($k) && $v == NULL ){
				
				unset($requst[$k]);
				
			}
			
		}
		
		// request array must contanie at least one item
		
	  if(count($requst) >= 1){
	  	
	  	foreach ($requst as $k => $v){
	  		
	  		if(isset($k) && $v != NULL){
	  			
	  			// set the first item as a Controller Class
	  			
	  			$controller_class = trim(strtolower($v));
	  			
	  			unset($requst[$k]);
	  			
	  		    // the next item in request array will set as Class Method
	  		    
	  			// i prefer new foreach to hook the Class Method
	  			
	  			foreach ($requst as $k => $v){
	  				
	  				if(isset($k) && $v != NULL){
	  					
	  					$controller_method = trim(strtolower($v));
	  					
	  					unset($requst[$k]);
	  					
	  					break;
	  					
	  				}
	  				
	  			}
	  			
	  		}
	  		
	  		// this line make Class Method nulled if !(isset)
	  		
	  		$controller_method = (!isset($controller_method) || (isset($controller_method) && $controller_method==NULL)) ? NULL : $controller_method;
	  		
	  		break;
	  		
	  	}
	  	
		//test   print '<br>'.$controller_class.'<br>'.$controller_method.'<br>';
		
	  }else{
	  	
	  	throw new Exception('Error-> incorrect request please fix your this request.'.$_SERVER['REQUEST_URI']);

	  }
		
	}else{
		
		throw new Exception('Error-> incorrect request please fix your this request.'.$_SERVER['REQUEST_URI']);
		
	}
	
	$GLOBALS['REQUSET'] = array($controller_class,$controller_method);
	
	// return controller class and his method
	
	return array($controller_class,$controller_method);

}

require_once SYSROOT.'hooks/hook1'.EXT;

// hook will try to find this controller class

Hook::HookThisReq(connector1());

?>

