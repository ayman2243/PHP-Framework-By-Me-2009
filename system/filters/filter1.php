<?php
class Cfilter{
	
	public function __construct(){
		
		//some thing to do ..................................
	}
	
}

class Filter1 extends Cfilter{
	
	public function __construct(){
		
		//some thing to do ..................................
		
		parent::__construct();
		
	}
	
	public  function CharFilter($words){
		
		if(@is_array($words)){
			
			foreach($words as $k => $v){
				
				$words[$k] = strip_tags($v);
				
				$words[$k] = strtr($words[$k],'()*^%$#@!|\\][{},+','                 ');
				
				$tr1 = explode(' ', $words[$k]);
				
				$words[$k] = implode('', $tr1);
				
			}
			
		}
		
		return $words;	
	}
	
}

?>