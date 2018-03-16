<?php

require_once SYSROOT.'core/workspace'.EXT;

class CHook{
	
	public function __construct(){
		
		//some thing to do ..................................
		
	}
	
}

class Hook extends CHook{
	
	
	public function __construct(){
		
		//some thing to do ..................................
		
		parent::__construct();
		
	}
	
	 static public function HookThisReq($request = array()){
		
		if(count($request) > 3 || count($request) < 1){
			
			die(error404());
			
		}else{
			
			
			Hook::CheckThisReq(Hook::CallFitter()->CharFilter($request));
			
	
		}
						
	}
	
	static private  function CallFitter(){
		
		require SYSROOT.'filters/filter1'.EXT;
		
		return new Filter1();
		
	}
	
	static private function CheckThisReq($request){
		
		if((isset($request) && $request == NULL) || !isset($request)){
			
			die(error404('You try to send a nulled request....'));
			
		}else{
			
			if(!file_exists(APPROOT.'controller/'.$request[0].EXT)){
				
				die(error404('you try to reach unknow controller '.$request[0]));
				
			}else{
				
				$PrivateMethodes = array("__construct","__get",$request[0]);
				
				$request[1] = (in_array($request[1], $PrivateMethodes) || substr($request[1],0,2) == "__")?"0-|-0-UNKNOW-/+":$request[1];
				
				$request[1] = (isset($request[1]) && $request[1] == $request[0])?'':$request[1];
				
				include_once (APPROOT.'controller/'.$request[0].EXT);
				
				$class_methods = get_class_methods($request[0]);
				
				foreach($class_methods as $k => $n)
				{
				    if(in_array($n, $PrivateMethodes) || substr($n,0,2) == "__")
				    {	
				    	$class_methods = array_merge(array_diff($class_methods, array($n)));    	
				    }
				}
				
				
				if($request[1] != NULL && !in_array($request[1], $class_methods)){
					
					die(error404('you try to reach unknow controller method '.$request[1]));
					
				}else if($request[1] != NULL && @in_array($request[1], $class_methods)){
					
					$class = $request[0];
					
					define("LOADEDCLASS65", $class);
					
					$method = $request[1];
					
					define("METHOD", $method);
					
					$ControllerLoad = new $class;
					
					$ControllerLoad->$method();
					
				}else if($request[1] == NULL){
					
					$class = $request[0];
					
					define("CLASS", $class);
					
					$method = $class_methods[0];
					
					define("METHOD", $method);
					
					$ControllerLoad = new $class;
					
					$ControllerLoad->$method();
				}
				
			}
			
		}
		
	}

}
?>