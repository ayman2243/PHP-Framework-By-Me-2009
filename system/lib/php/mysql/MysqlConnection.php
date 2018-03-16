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

abstract class AB_Mysql{
	
	abstract public function Connection();
	
	abstract public function CloseConnection(); 
}


class DB_mysql extends AB_Mysql{
	
	protected $link;
	
	private $db_host, $db_user, $db_pass;
	
	static public $db_name;
	
	public function __construct(){
		
		$this->db_host = 'localhost';
		$this->db_user = 'root';
		$this->db_pass = '';
		self::$db_name = (self::$db_name == NULL) ? 'student' : self::$db_name;
		$this->Connection();
	}
	
	final public function Connection(){
		
		$this->link = mysql_connect($this->db_host,$this->db_user,$this->db_pass)
		or die('Please Check your mysql information in '.__FILE__.' line: '.__LINE__);
		
		$DB_SELECT = mysql_select_db(self::$db_name,$this->link) or 
		die('Please Check your db name at file '.__FILE__.' line: '.__LINE__);
		
	}
	
	final public function CloseConnection(){
		mysql_close($this->link);
	}
	
}

?>