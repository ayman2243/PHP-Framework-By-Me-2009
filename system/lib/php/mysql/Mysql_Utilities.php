<?php
/*
 *  Gomado FrameWork is A beta version  only for test
 *  
 *   Develop by Ayman Elgohary -> ayman2243@gmail.com
 *   
 *   website: webcober1.tk
 *   
 *   phone: +966-0531929262
 *   
 *   
 *   
 *   
 *   Mysql Function will help you to control 
 *   mysql result to make it easy to count result and toggler the 
 *   result.
 *   
 *   
 *   this functions only work in array result 
 *   and if it false will return null array 
 *   => array().
 * 
 */

  class mysql_functions {
  	
  	private $mysql_result,$mysql_table;
  	
  	public function __construct($result,$table){
  		
  		$this->mysql_result = $result;
  		
  		$this->mysql_table = $table;
  	
  	}
  	
  	public function result($start = NULL, $per=NULL){
  		if(count($this->mysql_result) > 1){
  			
  		   if($start != NULL) return $this->toggler($this->mysql_result, $start,$per);
  		   
  		   else  return $this->mysql_result;
  	     
  		}elseif (count($this->mysql_result) == 1){
  			
  	     	return $this->mysql_result;
  	     
  		 }else{
  	     	return array();
  	     }		    
  	}
  	
  	public function count(){
  		return count($this->mysql_result);
  	}
  	
    private function toggler(array $result, $start, $per=NULL){
		$new = array();
		$record = 1;
		foreach($result as $k => $v){
		if($k == $start)
		$work = 'on';
		if(isset($work) && $work == 'on'){	
	    $new[$record] = $result[$k];
		if($record == $per)
	        break;
			$record ++;
		}
		}
		return $new;
    }
    
    public function avg($cloum = NULL)
	{
		if($cloum == NULL){throw new Exception("Avg input must be not nulled");}
	
		$average = 0;
		$z=0;
		
		if(count($this->mysql_result) != 0 )
		{
			foreach ($this->mysql_result as $v)
			{
				if(in_array($cloum, array_keys($v)))
				{
					if(is_numeric($v[$cloum]))
					{	
						$average += $v[$cloum];	
						$z++;	
					} 
				}else
				{
				    throw new mysqli_sql_exception("[-------- you try to call to unknow column name ---------]");	
				}
			}
			
			return ($average/$z);
		}else{
			return 0;
		}
	}
	
	public function first($cloum = NULL)
	{
		if($cloum == NULL){throw new Exception("First input must be not nulled");}
			
		if(count($this->mysql_result) != 0 )
		{
			foreach ($this->mysql_result as $v)
			{
				if(in_array($cloum, array_keys($v)))
				{
					return  $v[$cloum];
					break;
				}else
				{
				    throw new mysqli_sql_exception("[-------- you try to call to unknow column name ---------]");	
				}
			}
		}else{
			return NULL;
		}
	}

	public function last($column = NULL)
	{
		if($column == NULL){throw new Exception("Last input must be not nulled");}
	
		if(count($this->mysql_result) != 0 )
		{
		     $num = count($this->mysql_result);
		     
		     if(in_array($column, array_keys($this->mysql_result[$num])))
		     {
		     	return $this->mysql_result[$num][$column];
		     }
		     else
		     {
		     	throw new mysqli_sql_exception("[-------- you try to call to unknow column name ---------]");
		     }

		     
		}
		else
		{
			return NULL;
		}
	}

	public function max($column = NULL)
	{
		if($column == NULL){throw new Exception("Max input must be not nulled");}
		if(count($this->mysql_result) != 0 )
		{
			$value = array();
			
		     foreach ($this->mysql_result as $v)
		     {
		     	if(in_array($column, array_keys($v)))
		     	{
		     		$value[] = $v[$column];
		     	}
			    else
			    {
			        throw new mysqli_sql_exception("[-------- you try to call to unknow column name ---------]");
			    }
		     }
		     return max($value);
		}
		else
		{
			return 0;
		}
	}
	
  	public function min($column=NULL)
	{
		if($column == NULL){throw new Exception("Min input must be not nulled");}
		
		if(count($this->mysql_result) != 0 )
		{
			$value = array();
			
		     foreach ($this->mysql_result as $v)
		     {
		     	if(in_array($column, array_keys($v)))
		     	{
		     		$value[] = $v[$column];
		     	}
			    else
			    {
			        throw new mysqli_sql_exception("[-------- you try to call to unknow column name ---------]");
			    }
		     }
		     return min($value);
		}
		else
		{
			return 0;
		}
	}
	
    public function sum($column=NULL)
	{
		if($column == NULL){throw new Exception("Sum input must be not nulled");}
	
		if(count($this->mysql_result) != 0 )
		{
			$value = array();
			
		     foreach ($this->mysql_result as $v)
		     {
		     	if(in_array($column, array_keys($v)))
		     	{
		     		$value[] = $v[$column];
		     	}
			    else
			    {
			        throw new mysqli_sql_exception("[-------- you try to call to unknow column name ---------]");
			    }
		     }
		     return array_sum($value);
		}
		else
		{
			return 0;
		}
	}	
	
	private function PinMysql($table,$column = NULL)
	{
		$AcceccMysqlFunction = new db();
		if($column != NULL){ $AcceccMysqlFunction->select_column($column); }
		if($AcceccMysqlFunction->select($table) == false){ return false; }
		else { return true;}
	} 
  }

?>
