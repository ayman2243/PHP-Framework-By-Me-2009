<?php

class LoginSystem{
	
	private $username, $userid;
	
	public function vars($username,$password,$TabelName,$DBname = NULL)
	{
		$this->username = $username;
		
		$this->password = $password;
		
		if($DBname != NULL)
		{
			db::$db_name = $DBname;
		}
		
		$PrivateDB = new db();
		
		$PrivateDB->where(array("username="=>$username,"password="=>$password));
		
		 if($PrivateDB->select($TabelName)->count() == 1)
		 {
		 	$this->userid = $PrivateDB->select($TabelName)->first("id");
		 	
		 	$this->OnloginSuccuce();
		 	
		 	return "Succseful login";
		 }
		 else
		 {
		 	$this->OnloginFaild();
		 	
		 	return "Faild to login please try agian";
		 }
	
	}
	
	public function OnloginSuccuce()
	{
		$_SESSION['login'] = array('username' => $this->username,'userid' => $this->userid);
		
		header("location:./panel/");                          
	}
	
	public function OnloginFaild()
	{
		//print "Faild to login please try agian";
	}
	
	public function Logout()
	{
		if(isset($_SESSION['login']) && count($_SESSION['login']) > 1)
		{
			unset($_SESSION['login']);
			
			header("location:".BASEURL.'index.php/back/login');
			
			return true;
		}
		else
		{
			header("location:".BASEURL.'index.php/back/login');
		}
	}
	
}

?>