<?php

/*
 * 
 *  Gomado FrameWork is A beta version  only for test
 *  
 *   Develop by Ayman Elgohary -> ayman2243@gmail.com
 *   
 *   website: gomado.com | exdevelop
 *   
 *   phone: +20121207245
 *   
 *   
 *   ///////
 *   
 *   requierd
 *     types:
 *       name => numbers and letters only
 *       email => valid as email 
 *       int => intager
 *       date 
 *       equal 
 *       ip
 *       max => $int
 *       min => $int
 *        
 *   
 *   array(
       'name' => array( $_POST['name'], 'required' , 'name' , 'max'=>50, 'min'=>5 ),
       'email' => array( $_POST['email']  , 'required', 'email' ,  'max'=>50, 'min'=>5 ),
       'company name' => array( $_POST['cname'] , 'name' , 'max'=>50, 'min'=>5 ),
       'phone' => array( $_POST['phone'], 'required' , 'int' , 'max'=>50, 'min'=>5 ),
	   'subject' => array( $_POST['subject'], 'required' , 'name' , 'max'=>50, 'min'=>5 ),
	   'message' => array( $_POST['message'], 'required'  , 'max'=>2400, 'min'=>5 ),
	   'date' => array( $_POST['date'], 'required' , 'date' ),
	   'type' => array( $_POST['type'], 'required' , 'equal'=>'contact' )
	   
       );
 * 
 * 
 */

class validate{

    private  $error = NULL;
	private  $script = "<script> $(document).ready(function() {";
	
	
	public function CheckChars($input){
		return strtr($input,'()*^%$#@!=|\\][{},+','                  ');
	}
/*	
	public function FilterName($input, $option = NULL){
		if(filter_var($input, FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_AMP) != $input || strip_tags($input) != $input || $this->CheckChars($input) != $input){
			return false;
		}else{
			
			
			$letters=$digits=$i=0;
            $retval=array();
            while ($i<strlen($input)) {
            if (preg_match("/[a-zA-Z]/",$input{$i}))
            $letters++;
            else if (preg_match("/[0-9]/",$input{$i}))
            $digits++;
            ++$i;
            }
			
			if($letters  == 0){
				return false;
			}else{
				return true;
			}
			
			
			
		}
	}
*/
/*		
	public function FilterInt($input, array $option = array()){
		if(!filter_var((int)$input, FILTER_VALIDATE_INT)){
			return false;
		}else{
			
			
			$letters=$digits=$i=0;
            $retval=array();
            while ($i<strlen($input)) {
            if (preg_match("/[a-zA-Z]/",$input{$i}))
            $letters++;
            else if (preg_match("/[0-9]/",$input{$i}))
            $digits++;
            ++$i;
            }
			
			if($letters  != 0){
				return false;
			}else{
				if($this->CheckChars($input) != $input || strip_tags($input) != $input){
					return false;
				}else{
					
					return true;
				}
			}
			
		}
	}
	
*/	
	public function FilterUrl($input, $option = NULL){
		if(!filter_var($input, FILTER_VALIDATE_URL)){
			return false;
		}else{
		    return true;
		}
	}
	
	public function FilterEmail($input, $option = NULL){
		if(!filter_var($input, FILTER_VALIDATE_EMAIL)){
			return false;
		}else{
			return true;
		}
	}
	
	public function FilterIp($input, $option = NULL){
		if(!filter_var($input, FILTER_VALIDATE_IP)){
			return false;
		}else{
			return true;
		}
	}
	
	public function FilterDate($input, array $option = array()){
		if(!preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $input, $parts)){
			return false;
		}else{
			// don't forget to filter $option array as intger only
			$mini = (isset($option[0]) && $this->FilterInt($option[0]) != false) ? $option[0] : 1900;
			$max = (isset($option[1]) && $this->FilterInt($option[1]) != false) ? $option[1] : 2012;
			
		   if( ($parts[1] < $mini  || $parts[1] > $max) || ($parts[2] < 1 || $parts[2] > 13) 
		                  || ($parts[3] < 1 || $parts[3] > 31)){
			 return false;  
		   }else{
		   	 return true;
		   }
		}
	}
	
	public function FilterUsername($input , $option=NULL){
		
		 if(!preg_match('/^([a-zA-Z]+[a-zA-Z0-9\-\_\.]+)$/', $input)){
			return false;
		}else{
			return true;
		}
		
	}
	
   public function FilterPhone($input , $option=NULL){
		
		 if(!preg_match('/^([0-9]|\+[0-9]{1,})(-|)([0-9]+)$/', $input)){
			return false;
		}else{
			return true;
		}
		
	}
	
   public function FilterName($input , $option=NULL){
		
		 if(!preg_match('/^([a-zA-Z])([a-zA-Z0-9\s]+)$/', $input)){
			return false;
		}else{
			return true;
		}
		
	}
	
   public function FilterInt($input, $option=NULL){
   	
       if(!preg_match('/^([0-9])([0-9]+)$/', $input)){
			return false;
		}else{
			return true;
		}
   	
   }
   
  public function FilterStripTags($input, $option=NULL){
   	
       if(strip_tags($input) != $input){
			return false;
		}else{
			return true;
		}
   	
   }
   
  public function FilterHarmfulChars($input, $option=NULL){
   	
       if(preg_match('/[!@#\$\%\^\&\*\(\)\_\+\}\{\:\'\"\;\?\>\<\|\/]+/',$input)){
			return false;
		}else{
			return true;
		}
   	
   }
   
  public function FilterHiPassword($input){
  	
  	  if(!preg_match('/([a-z]{1,})/', $input)){
  	     return false;	
      }else if(!preg_match('/([A-Z]{1,})/', $input)){
      	return false;
      }else if(!preg_match('/([0-9]{1,})/', $input)){
      	return false;
      }else{
      	return true;
      }
  	
  }

  public function FilterType($input,array $types){
  	
  	$vaild = 0;
  	
  	$r1 = explode(".", $input);
	$ext =  end($r1);
  	
  	foreach ($types as $v):
  	
  	    if(strtolower($ext) == strtolower($v)){
  	    	$vaild = 1;
  	    }
  	
  	endforeach;
  	
  	return ($vaild==0)?false:true;
  }
	
	public function input(array $inputs){
		
		
		
		foreach($inputs as $k => $v):
			 
			 $id = $k;
		     $value = $v[0];
	          
			  unset($v[0]);
			  		 
		       foreach($v as $k2 => $v2):
			       
				     
				   if(in_array('required',$v)  && ($value == NULL || !isset($value))){
					   
					   $this->error .= "<b style=\"text-transform:capitalize;\">".$id."</b> is required" . "\n";
					   $this->script .= ' $("#'.$id.'").addClass("error"); ';
				       break;
				   }
				   
				   if(!in_array('required',$v)  && $value == NULL ){
					   
					   unset($inputs[$id]);
				       break;
				   }
				   
				   if(in_array('max',array_keys($v)) && (strlen($value) > $v['max'] )){
					   
					   $this->error .= "<b style=\"text-transform:capitalize;\">".$id."</b> please enter at max ".$v['max']." characters" . "\n";
					   $this->script .= '$("#'.$id.'").addClass("error");';
				       break;
				   }
				   
				   if(in_array('min',array_keys($v)) && (strlen($value) < $v['min'] )){
					   
					   $this->error .= "<b style=\"text-transform:capitalize;\">".$id."</b> please enter at least ".$v['min']." characters" . "\n";
					   $this->script .= '$("#'.$id.'").addClass("error");';
				       break;
				   }
				   
				   if(in_array('equal',array_keys($v)) && $value != $v['equal'] ){
					   
					   $this->error .= "<b style=\"text-transform:capitalize;\">".$id."</b> is not right" . "\n";
					   $this->script .= '$("#'.$id.'").addClass("error");';
				       break;
				   }
				   
				   if(in_array('int',$v) && $this->FilterInt($value) == false){
					   
					   $this->error .= "<b style=\"text-transform:capitalize;\">".$id."</b> must be a valid numbers." . "\n";
					   $this->script .= '$("#'.$id.'").addClass("error");';
				       break;
				   }
				   
				   if(in_array('url',$v) && $this->FilterUrl($value) == false){
					   
					   $this->error .= "<b style=\"text-transform:capitalize;\">".$id."</b> must be a valid url." . "\n";
					   $this->script .= '$("#'.$id.'").addClass("error");';
				       break;
				   }
				   
				   if(in_array('email',$v) && $this->FilterEmail($value) == false){
					   
					   $this->error .= "<b style=\"text-transform:capitalize;\">".$id."</b> must be a valid email." . "\n";
				       $this->script .= '$("#'.$id.'").addClass("error");';
				       $this->script .= '$("#'.$id.'").addClass("vtip");';
				       $this->script .= '$("#'.$id.'").attr("title", "Please enter a valid email");';
					   break;
				   }
				   
				   if(in_array('date',$v) && $this->FilterDate($value) == false){
					   
					   $this->error .= "<b style=\"text-transform:capitalize;\">".$id."</b>  must be a valid date in this format 2000-01-29" . "\n";
					   $this->script .= '$("#'.$id.'").addClass("error");';
				       break;
				   }
				   
				   if(in_array('ip',$v) && $this->FilterIp($value) == false){
					   
					   $this->error .= "<b style=\"text-transform:capitalize;\">".$id."</b>  must be a valid ip address." . "\n";
					   $this->script .= '$("#'.$id.'").addClass("error");';
				       break;
				   }
				   
	              if(in_array('username',$v) && $this->FilterUsername($value) == false){
					   
					   $this->error .= "<b style=\"text-transform:capitalize;\">".$id."</b> <span>is invalid must be like ayman or ayman66</span>" . "\n";
					   $this->script .= '$("#'.$id.'").addClass("error");';
				       break;
				   }
	              if(in_array('phone',$v) && $this->FilterPhone($value) == false){
					   
					   $this->error .= "<b style=\"text-transform:capitalize;\">".$id."</b> <span>is invalid must be like 5913556 or +2-035913556</span>" . "\n";
					   $this->script .= '$("#'.$id.'").addClass("error");';
				       break;
				   }
				   
	              if(in_array('name',$v) && $this->FilterName($value) == false){
					   
					   $this->error .= "<b style=\"text-transform:capitalize;\">".$id."</b> <span>is invalid must be letters and digit only</span>" . "\n";
					   $this->script .= '$("#'.$id.'").addClass("error");';
				       break;
				   }
				   
	              if(in_array('strip',$v) && $this->FilterStripTags($value) == false){
					   
					   $this->error .= "<b style=\"text-transform:capitalize;\">".$id."</b> <span>is invalid must not contain any tags</span>" . "\n";
					   $this->script .= '$("#'.$id.'").addClass("error");';
				       break;
				   }
				   
	              if(in_array('chars',$v) && $this->FilterHarmfulChars($value) == false){
					   
					   $this->error .= "<b style=\"text-transform:capitalize;\">".$id."</b> <span>is invalid must not contain any harmful chars</span>" . "\n";
					   $this->script .= '$("#'.$id.'").addClass("error");';
				       break;
				   }
				   
	              if(in_array('hipassword',$v) && $this->FilterHiPassword($value) == false){
					   
					   $this->error .= "<b style=\"text-transform:capitalize;\">".$id."</b> <span> must contain at least one uppercase, lowercase and digit</span>" . "\n";
					   $this->script .= '$("#'.$id.'").addClass("error");';
				       break;
				   }
				   
	              if(in_array('type',array_keys($v)) && $this->FilterType($value,$v['type']) == false){
					   
					   $this->error .= "<b style=\"text-transform:capitalize;\">".$id."</b> <span> is invalid type only ".implode(' ',$v['type'])."</span>" . "\n";
					   $this->script .= '$("#'.$id.'").addClass("error");';
				       break;
				   }
				   
	              if(in_array('morethan',array_keys($v)) && $value < $v['morethan']){
					   
					   $this->error .= "<b style=\"text-transform:capitalize;\">".$id."</b> <span> is invalid</span>" . "\n";
					   $this->script .= '$("#'.$id.'").addClass("error");';
				       break;
				   }
				   
	              if(in_array('lessthan',array_keys($v)) && $value > $v['lessthan']){
					   
					   $this->error .= "<b style=\"text-transform:capitalize;\">".$id."</b> <span> is invalid</span>" . "\n";
					   $this->script .= '$("#'.$id.'").addClass("error");';
				       break;
				   }
				   
				   
			   endforeach;
		
		endforeach;
		$this->javascript($inputs);
		return ($this->error != NULL)?nl2br($this->error)."\n".$this->script."});</script>":1;
	}
	
	
	private function javascript(array $inputs){
		
		foreach ($inputs as $k => $v):
		
		  //  $this->script .= "  document.getElementById('".$k."').value = encode(atob('".base64_encode($v[0])."')); ";
		    
		    $this->script .= '$("#'.$k.'").val(decodeURIComponent("'.rawurlencode($v[0]).'")) ;';
		
		endforeach;
		
	}
	
	// \" => \\" => \\\" ||| \\" => \\\"
	//$this->script .= "document.getElementById('".$id."').value = '".$value."';";
	
}




?>