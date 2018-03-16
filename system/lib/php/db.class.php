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
 */

require_once SYSROOT.'lib/php/mysql/MysqlConnection'.EXT;

require_once SYSROOT.'lib/php/mysql/Mysql_Utilities'.EXT;

// where(array $elemntes || $ID)
// select ("*" ,$table ,WHERE() ,other);
// selectIN ("*" ,$table1 ,$table2 ,ON ,OrderBY||Limit);
// selectB($condition)
// insert($table,array $data, $Othetr)
// update($table,array $data, WHERE())
// delete() // back_up

// #################

// ->result($condition)
// ->count($condition)
// ->status(DEBGINFO)	
// ->undo()
// ->Avg(*)
// ->first(*)
// ->last(*)
// ->max(*)
// ->min(*)
// ->sum(*)
// str_replace($this->harmful,$this->replace,$v)

class db extends DB_mysql{
	
	private static $WHERE,$COLUMNS;
	private $harmful = array("'",'"',"\\");
	private $replace = array("''",'"',"\\\\");
	
	public function where($W=NULL){
		$where = "WHERE ";
	    if(is_array($W))
		{foreach($W as $k => $v){$array_keys = array_keys($W);$array_values = array_values($W);
	    foreach($array_keys as $k112 => $v112){if($v112 == $k){$next = $k112+1;}}
	    $multi = explode('|',$k);if(is_array($v)){foreach($v as $k1 => $v2){$array_keys2 = array_keys($v);
		$array_values2 = array_values($v);// $em = (end($v) == $v2)? (is_array($W[$k]))?" OR ": (end($W) == $v)?"":" AND " :" OR ";
	    if(end($array_keys2) === $k1){if(isset($array_values[$next]) && is_array($array_values[$next])){
		$em = " OR ";$array_next = 1;}else if(isset($array_values[$next]) && !is_array($array_values[$next])&&$array_keys[$next]!=NULL)
		{$em = " AND ";}else{$em = NULL;}}else{$em = " OR ";}if(count($v) > 0){if(end($array_keys2) !== $k1 ){
		if(isset($array_values[$next]) && is_array($array_values[$next]) ){if(count($v) > 2){foreach($v as $fk => $fv){
		$first = $fv;break;}if($v2 == $first){$rm = "((";}else{$rm = NULL;}}else{$rm = "((";}}else{if(count($v) > 2){
		foreach($v as $fk => $fv){$first = $fv;break;}if($v2 == $first){$rm = "(";}else{$rm = NULL;}}else{$rm = "(";}}}
		else{$rm = NULL;}if(end($array_keys2) === $k1){if(count($v) > 1 && isset($array_values[$next-1]) && is_array($array_values[$next-1]) && 
		isset($array_values[$next-2]) && is_array($array_values[$next-2])){
		if(isset($array_values[$next-3]) && is_array($array_values[$next-3])){$rm2 = ")";}else{
		if(isset($array_values[$next-2]) && is_array($array_values[$next-2]) && count($array_values[$next-2])==1){$rm2 = ")";}
		else{$rm2 = "))";}}}else{if((!isset($array_values[$next-2]) && count($v)==1) || (isset($array_values[$next-2]) &&
		is_array($array_values[$next-2]) && count($array_values[$next-2])==1) || (isset($array_values[$next-2]) && 
		!is_array($array_values[$next-2]) && count($v)==1)){$rm2 = NULL;}else{if(end($array_keys2) === $k1){$rm2 = ")";}
		else{$rm2 = NULL;}}}}else{$rm2 = NULL;}}else{$rm = NULL;$rm2 = NULL;}
		if(count($multi) > 1){$NUM = (!isset($NUM))?0:$NUM;if(!isset($multi[$NUM])){$k = $multi[$NUM-1];$NUM--;}
		else{$k = $multi[$NUM];}$NUM++;}$k1 =(is_numeric($k1))?"=":$k1;
		$where .= $rm.$k." ".$k1." '".mysql_real_escape_string($v2)."'".$rm2.$em;
		}}else{$em = (end($array_keys) == $k)?NULL:" AND ";
		$ds = ($k != NULL)?" '".mysql_real_escape_string($v)."'":NULL;
		$where .= $k.$ds.$em;}}}else{throw new Exception("Where input must be an array and not nulled");}
		self::$WHERE = $where;
		return self::$WHERE;
	}
	
	public function __unset($name){
		if($name == 'where'){
			if(self::$WHERE == NULL) return false; else return true;
			self::$WHERE = NULL;
		}
		if($name == 'columns'){
			if(self::$COLUMNS == NULL) return false; else return true;
			self::$COLUMNS = NULL;
		}
		if($name!='where'||$name!='columns')
		{throw new Exception("you can only unset where , columns in query statment.");}
	}
	
	public function select_column($W){
		self::$COLUMNS = mysql_real_escape_string($W);
	}
	
	public function select($table,$others = NULL){
		$cloums = (self::$COLUMNS==NULL)?'*':self::$COLUMNS;
		$query = mysql_query("SELECT ".$cloums." FROM ".$table." ".self::$WHERE." ".mysql_real_escape_string($others)) or false;
		self::$COLUMNS = NULL;
	    // return ($query==false)?false:true;
	    
	    
		$result = array();	
		$z = 1;
		if($query != false && mysql_num_rows($query) == true){
			while ($row = mysql_fetch_assoc($query)){
				  $result[$z] = $row;
				  $z++;
			}
		}else{
		/*throw new Exception("########################################################################################
		############################################################
		 Invalid table {".$table."} name Or not found in db---->(".self::$db_name.")
		###########################################################################################################
		 ########################################################### ");*/	
			//return false;
		}
		if($query == false){throw new mysqli_sql_exception("\n"."Invalid table <".$table."} name Or not found in db---->(".self::$db_name.")");}else{ return new mysql_functions($result,$table);}
	}
	
	public function selectLEFT($table1,$table2,$on,$others=NULL){
		/*
		 * SELECT Persons.LastName, Persons.FirstName, Orders.OrderNo
		 * FROM Persons
		 * INNER JOIN Orders
		 * ON Persons.P_Id=Orders.P_Id
		 * ORDER BY Persons.LastName
		 */
		$cloums = (self::$COLUMNS==NULL)?'*':self::$COLUMNS;
		$query = mysql_query("SELECT ".$cloums." FROM ".$table1." LEFT JOIN ".$table2." ON ".$on." ".self::$WHERE." ".$others) or false;
		self::$COLUMNS = NULL;

		$result = array();	
		$z = 1;
		if($query != false && mysql_num_rows($query) == true){
			while ($row = mysql_fetch_assoc($query)){
				  $result[$z] = $row;
				  $z++;
			}
		}else{
		/*throw new Exception("########################################################################################
		############################################################
		 Invalid table {".$table."} name Or not found in db---->(".self::$db_name.")
		###########################################################################################################
		 ########################################################### ");*/
			//return false;	
		}
		if($query == false){throw new mysqli_sql_exception("Please Check your table name");}else{ return new mysql_functions($result,$table1);}		
	}
	
	public function selectRIGHT($table1,$table2,$on,$others=NULL){
		/*
		 * SELECT Persons.LastName, Persons.FirstName, Orders.OrderNo
		 * FROM Persons
		 * INNER JOIN Orders
		 * ON Persons.P_Id=Orders.P_Id
		 * ORDER BY Persons.LastName
		 */
		$cloums = (self::$COLUMNS==NULL)?'*':self::$COLUMNS;
		$query = mysql_query("SELECT ".$cloums." FROM ".$table1." RIGHT JOIN ".$table2." ON ".$on." ".self::$WHERE." ".$others) or false;
		self::$COLUMNS = NULL;

		$result = array();	
		$z = 1;
		if($query != false && mysql_num_rows($query) == true){
			while ($row = mysql_fetch_assoc($query)){
				  $result[$z] = $row;
				  $z++;
			}
		}else{
		/*throw new Exception("########################################################################################
		############################################################
		 Invalid table {".$table."} name Or not found in db---->(".self::$db_name.")
		###########################################################################################################
		 ########################################################### ");*/
			//return false;	
		}
		if($query == false){throw new mysqli_sql_exception("Please Check your table name");}else{ return new mysql_functions($result,$table2);}		
	}
	
	public function selectINNER($table1,$table2,$on,$others=NULL){
		/*
		 * SELECT Persons.LastName, Persons.FirstName, Orders.OrderNo
		 * FROM Persons
		 * INNER JOIN Orders
		 * ON Persons.P_Id=Orders.P_Id
		 * ORDER BY Persons.LastName
		 */
		$cloums = (self::$COLUMNS==NULL)?'*':self::$COLUMNS;
		$query = mysql_query("SELECT ".$cloums." FROM ".$table1." INNER JOIN ".$table2." ON ".$on." ".self::$WHERE." ".$others) or false;
		self::$COLUMNS = NULL;

		$result = array();	
		$z = 1;
		if($query != false && mysql_num_rows($query) == true){
			while ($row = mysql_fetch_assoc($query)){
				  $result[$z] = $row;
				  $z++;
			}
		}else{
		/*throw new Exception("########################################################################################
		############################################################
		 Invalid table {".$table."} name Or not found in db---->(".self::$db_name.")
		###########################################################################################################
		 ########################################################### ");*/
			//return false;	
		}
		if($query == false){throw new mysqli_sql_exception("Please Check your table name");}else{ return new mysql_functions($result);}		
	}
	
	public function selectFULL($table1,$table2,$on,$others=NULL){
		/*
		 * SELECT Persons.LastName, Persons.FirstName, Orders.OrderNo
		 * FROM Persons
		 * INNER JOIN Orders
		 * ON Persons.P_Id=Orders.P_Id
		 * ORDER BY Persons.LastName
		 */
		$cloums = (self::$COLUMNS==NULL)?'*':self::$COLUMNS;
		$query = mysql_query("SELECT ".$cloums." FROM ".$table1." FULL JOIN ".$table2." ON ".$on." ".self::$WHERE." ".$others) or false;
		self::$COLUMNS = NULL;

		$result = array();	
		$z = 1;
		if($query != false && mysql_num_rows($query) == true){
			while ($row = mysql_fetch_assoc($query)){
				  $result[$z] = $row;
				  $z++;
			}
		}else{
		/*throw new Exception("########################################################################################
		############################################################
		 Invalid table {".$table."} name Or not found in db---->(".self::$db_name.")
		###########################################################################################################
		 ########################################################### ");*/
			//return false;	
		}
		if($query == false){throw new mysqli_sql_exception("Please Check your table name");}else{ return new mysql_functions($result);}		
	}
	
	public function insert($table,array $data,$other = NULL){
		$check = array_keys($data);
		if(!is_int($check[0])){
		$link = "INSERT INTO ".$table."(";
		$R = count($data);
		foreach ($data as $k => $v):
		$em = ($R == 1)? '': ",";
		   $link .= $k.$em;
		 $R--;  
		endforeach;
		$link .= ") VALUES (";
		$R = count($data);
		foreach($data as $k => $v):
		$em = ($R == 1)? '': ",";
		   $link .= "'".mysql_real_escape_string($v)."'".$em;
		$R--;     
		endforeach;
		$link .= ")";
		// return $link;
		}else{
		$link = "INSERT INTO ".$table." VALUES(";
		$R = count($data);
		foreach($data as $k => $v):
		$em = ($R == 1)? '': ",";
		   $link .= "'".mysql_real_escape_string($v)."'".$em;
		$R--;     
		endforeach;
		$link .= ")";
		// return $link;
		}
		
		$query = mysql_query($link) or false;
		return ($query==false)?false:true;
	}
	
	public function update($table, array $data){
		$link = "UPDATE ".$table." SET ";
		$R = count($data);
		foreach($data as $k => $v):
		  $em = ($R == 1)?'':',';
		  $link .= $k."='".mysql_real_escape_string($v)."'".$em.' ';
		  $R--;	
		endforeach;
		
		  
		$query = mysql_query($link." ".self::$WHERE) or false;
		return ($query==false)?false:true;
	}
	
	public function delete($Table,$BackUp = 'off'){
	    $link = "DELETE FROM ".$Table;
	/*
	 * SELECT LastName,Firstname
	 * INTO Persons_Backup
	 * FROM Persons
	 * WHERE City='Sandnes'
	 * 
	 * SELECT *
	 * INTO Persons_Backup
	 * FROM Persons
	 */
	    if($BackUp == 'on'){
	    $columns = (self::$COLUMNS == NULL)?'*':self::$COLUMNS;
	    $backup_link = "CREATE TABLE ".$Table."_backup SELECT *  FROM ".$Table;
	    $backup_query = mysql_query($backup_link." ".self::$WHERE) or false;
	       if($backup_query == false)
	          $backup_link = "INSERT INTO ".$Table."_backup SELECT *  FROM ".$Table;
	          $backup_query = mysql_query($backup_link." ".self::$WHERE) or false;
	    }
	
	    $query = mysql_query($link." ".self::$WHERE) or false;
	    return ($query==false)?false:true;
	}
	
    public function  DatabaseSetup(array $db){
	 // $conn = mysql_connect('localhost','root','');
	 // $db_select = mysql_select_db("new_gomado",$conn);
		$i = 1;
		$query = ''; 
		 $mass = '';
		 foreach($db as $table => $column):
		 $query .= 'CREATE TABLE '.$table. '( ';
		     foreach($column as $name => $option):
		     $query.= $name. ' ' .$option;
			  //	$query .= (count($column) == $i)? $i=0 : ',';
			 if(count($column) == $i){
			  //$query .= '**END**';
			  $i = 0;
			  }else{
		      $query .= ',';}$i++;
			 endforeach;
		   $query .=' )';
		   $create_tables = mysql_query($query);
		   $mass .= 'Creat table '.$table.' Succsees....'.'
		   <br> ....................query =>'. $query.'<br><br><br>';
		   $query = '';
		 endforeach;
		return $mass;
       // print $query;
		
		// $conn = mysql_connect('localhost','root','');
		// $db_create = mysql_query("CREATE DATABASE myinstaltion4");
		// $db_select = mysql_select_db("myinstaltion4",$conn);
		// $create_tables = mysql_query($query);
		// print 'Thank You Done ........';
	 }
	  
	public function free($condition,$functions = false){
	 ##########################
	        ##### this for mysql free action  ######
	 ##########################  
	      	
		$query = mysql_query($condition) or false;
		if($functions == false)
		  return ($query==false)?false:true;
		else {
	      $result = array();	
		  $z = 1;
		  if($query != false && mysql_num_rows($query) == true){
			while ($row = mysql_fetch_assoc($query)){
				  $result[$z] = $row;
				  $z++;
			}}
		  return ($query==false)?false:new mysql_functions($result);}
		
	}
		


	
}




?>