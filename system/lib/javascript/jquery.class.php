<?php

require_once 'system/lib/javascript/ConstructFunction/JqueryPlugins.php';


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

class jquery{
	
	private $JSCODE,$HTMLCODE1,$HTMLCODE2,$HTMLCODE3;
	
	private $Requirements = array();
	
	private $Additions = array();
	
	private $CssFiles = array();
	
	private $Error_load;
	
	public function __construct(){ /* setup start */ }
	
	public function setup(array $plugins)
	{
		foreach ($plugins as $key => $value)
		{
			if(is_numeric($key)) $key = $value;
			
			if(is_dir('js/'.$key))
			{
			    
				//check if requirements file is found
				if(file_exists('js/'.$key.'/req.txt'))
				{
					$req = file('js/'.$key.'/req.txt');
					
					// put required files in requirements var to check it later
					foreach ($req as $k => $v){ if($v != null){ $this->Requirements[] = trim($v); } }	
				}
				
			/*--------------------------------------------------------------------------------------------*/
				
				//check if the addition file is found
				if(file_exists('js/'.$key.'/add.txt'))
				{
					$add = file('js/'.$key.'/add.txt');
					
				    // put additions files in additions var to check it later
					foreach ($add as $k => $v){ if($v != null){ $this->Additions[] = $key.'/'.trim($v); } }
				}
				// must every plugins containe a addition file
				else
				{
					throw new Exception("i can't found addition file in <b>".$key."</b> folder");
				}
				
			/*--------------------------------------------------------------------------------------------*/
				    
				//call to construction function 
				if(function_exists($key) && $key($value) != NULL) $this->JSCODE .= "".$key($value).""."\n";	
				
			}
			else 
			{
				throw new Exception("i can't found <b>".$key."</b> folder in js folder to install it ");
			}
		}
		
		$this->Requirements = array_unique($this->Requirements);
		
	    // create an error message for reqiured files
		foreach ($this->Requirements as $k)
		{ if(!file_exists('js/'.$k)){ $this->Error_load .= 'file '.$k.' not found in js/[folder] <br>'; } }
		
	    //create html code to include the reqiurements files after if error_load is empty
		if($this->Error_load == NULL)
		{
			foreach ($this->Requirements as $k1)
				{
					$extReq = explode(".", $k1);
					
					if(strtolower(end($extReq)) == 'css')
					{
						$this->HTMLCODE1 .= '<link href="'.BASEURL.'js/'.$k1.'" rel="stylesheet" type="text/css">'."\n";
					}
					else 
					{
						$this->HTMLCODE1 .= '<script src="'.BASEURL.'js/'.$k1.'" type="text/javascript"></script>'."\n";
					}
				}	
		}
		else
		{
			throw new Exception($this->Error_load);
		}
		
		// create an error message for additions files
	    foreach ($this->Additions as $k)
		{ if(!file_exists('js/'.$k)){ $this->Error_load .= 'file '.$k.' not found in js/[folder] <br>'; } }
		
		
		//create html code to include the reqiurements files after if error_load is empty
		if($this->Error_load == NULL)
		{
			foreach ($this->Additions as $k3 => $css)
			{
			    $ext = explode(".", $css);
						
				if(strtolower(end($ext)) == "css")
				{
					$this->CssFiles[] = $css;

					unset($this->Additions[$k3]);
				}
			}
			
			foreach ($this->Additions as $num => $k1)
			{						
				$this->HTMLCODE2 .= '<script src="'.BASEURL.'js/'.$k1.'" type="text/javascript"></script>'."\n";
			}
					
		}
		else
		{
			throw new Exception($this->Error_load);
		}
				
		foreach ($this->CssFiles as $v3)
		{
			$this->HTMLCODE3 .= '<link href="'.BASEURL.'js/'.$v3.'" rel="stylesheet" type="text/css">'."\n";
		}
		
		
		
		$_SESSION['JScodeOutput'] = (!isset($_SESSION['JScodeOutput']))?array():$_SESSION['JScodeOutput'];
				
		for ($i=0; $i<1; $i++)
		{
			$cfid = rand("10","100000000000");
					
			if(!in_array($cfid, array_keys($_SESSION['JScodeOutput'])))
			{
				$_SESSION['JScodeOutput'][$cfid] = $this->JSCODE;
						
				break;
			}
					
		}
				
		$this->JSCODE = '<script src="'.BASEURL.'js/OutputScript.php?cfid='.$cfid.'" type="text/javascript"></script>';
		
		
		
		
		return $this->HTMLCODE3.$this->HTMLCODE1.$this->HTMLCODE2.$this->JSCODE;
		
	}
}


?>