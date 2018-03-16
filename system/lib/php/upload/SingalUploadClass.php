<?php


class upload_single_file_functions{
	
	private  $filename, $patch, $allowed_types, $max_size;
	// private  $one_time;
	private  $size, $type, $tmp_name, $name, $delete;
	private  $error, $progress  ;
	private $SpicalFormats= array('image/gif' => 'gif',
				                  'image/jpeg' => 'jpeg',
				                  'image/png' => 'png',
				                  'application/x-shockwave-flash' => 'swf',
				                  'image/psd' => 'psd',
				                  'image/bmp' => 'bmp',
				                  'image/tiff' => 'tiff',
				                  'image/tiff' => 'tiff',
				                  'image/jp2' => 'jp2',
				                  'image/iff' => 'iff',
				                  'image/vnd.wap.wbmp' => 'bmp',
				                  'image/xbm' => 'xbm',
				                  'image/vnd.microsoft.icon' => 'ico');
	
	public function __construct($finename,$patch,$type,$size){
	  if($patch == NULL){
			throw new Exception("set your upload folder first ####$-this->upload->patch(VAR PATCH)###");
		}else if($size == NULL){
			throw new Exception("set your max upload file size first ####$-this->upload->maxsize(VAR SIZE)###");
		}
	  if(isset($_FILES[$finename]) && $_FILES[$finename]["tmp_name"] != NULL && is_uploaded_file($_FILES[$finename]["tmp_name"])){
		  
	   $this->filename = $finename;
	   $this->patch = $patch;
	   $this->allowed_types = $type;
	   $this->max_size = $size; /// only testspace only @@@@@@@@@@@@@@@@@@@@@@@@@##############################
	
	   $this->tmp_name = $_FILES[$this->filename]['tmp_name'];
	   $this->size = $_FILES[$this->filename]['size'];
	   $this->type = $_FILES[$this->filename]['type'];
	   
	   return $this->Start();
	  
	  }else{
		
		$this->error = "unset";  
		$this->progress = false;
		$this->size = 0;
		$this->type = "invalid";
		$this->name = "invalid";
		$this->delete = true;
		$this->tmp_name = "invalid";
	  
	  }

// return false;	  
	}
	
	public function error(){
		if( $this->error != NULL)
		  return $this->error;
		 else
		  return 0; 	
	}
	
	public function size(){
		return $this->size;
	}
	
	public function type(){
		$r12 = explode(".", $_FILES[$this->filename]['name']);
	    $ext2 =  end($r12);
	    $etype2 = strtolower($ext2);
		return $etype2;
		//return $this->type;
	}
	
	public function tmp_name(){
		return $this->tmp_name;
	}
	
	public function progress(){
		return $this->progress;
	}
	
	public function name(){
		return $this->name;
	}
	
	public function dataurl(){
		// echo base64_encode(file_get_contents("../images/folder16.gif"))
			$data = "data:".$this->type().";base64,".base64_encode(file_get_contents($this->tmp_name()));
			return $data;
	}
	
	public function delete(){
		if($this->progress == false){
			return true;
		}else{
			if(file_exists($this->delete)){
				unlink($this->delete);
				return true;
			}else{
				return false;
			}
		}
	}
	
	private function Start(){
		
		$r12 = explode(".", $_FILES[$this->filename]['name']);
	    $ext2 =  end($r12);
	    $etype2 = strtolower($ext2);
	    
		if(in_array($etype2,$this->SpicalFormats) && validate_image($_FILES[$this->filename]['tmp_name']) === false){
			$this->error = "Invalid file type ".$this->filename;
			return false;
		}
		else if(is_array($this->allowed_types) && !in_array($etype2,$this->allowed_types) ){
			$this->error = "Invalid file type ".$this->filename;
			return false;
		}else if($_FILES[$this->filename]['size'] > $this->max_size){
			$this->error = "Too large file size at ".$_FILES[$this->filename]['name']." size= {".$_FILES[$this->filename]['size']."}";
			return false;
		}else if($_FILES[$this->filename]['error'] > 0){
			$this->error = "File containe errors at ".$_FILES[$this->filename]['name']." errors= {".$_FILES[$this->filename]['errors']."}";
			return false; // progress = false // error != NULL 
		}else{
			return $this->upload_file($this->filename);
		}
	}
	
	private function upload_file($filename){
		
		
		$this->rename_file();
		if(@move_uploaded_file($this->tmp_name,$this->patch.'/'.$this->name)){
			$this->progress = true;
			$this->delete = $this->patch.'/'.$this->name;
			return true;
		}else{
			$this->progress = false;
			$this->error("Can't Copy this file to his distnation....");
			return false;
		}
	}
	
	private function rename_file(){
		
		$basic = date("d-m-Y")."_";
		
		$r1 = explode(".", $_FILES[$this->filename]['name']);
	    $ext =  end($r1);
		
		for($i=0; $i<=10000000; $i++){
			$length = rand(10,150);
			$RoundChares = '0123456789abcdefghijklmnopqrstuvwxyzQWERTYUIOPLKJHGFDSAZXCVBNM';
			$string = "";
			for ($p = 0; $p < $length; $p++) {
          	//disable notice errors for this action...
			$vl = $RoundChares[mt_rand(0,strlen($RoundChares)-1)];
          	$string .= $vl;
            }
			
			$new_name = $basic.$string.'.'.$ext;
			
			if(!file_exists($this->patch.'/'.$new_name)){
				$this->name = $new_name;
				break;
			}
		}
		
		return $this->name;
	}

}

?>