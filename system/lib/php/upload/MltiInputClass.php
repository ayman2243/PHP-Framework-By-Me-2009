<?php
class MultiInput {

	private $inputname, $uploadPatch, $allowedTypes, $maxSize;
	
	private $tmp_name = array(), $type = array(), $size = array(), $name = array(), $delete = array(), $full_patch = array();
	
	private $error = NULL , $progress, $maxInput;
	
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
 
    public function __construct($input, $uploadPatch, $allowedTypes, $maxSize){
	  
	  if(isset($_FILES[$input]) && is_array($_FILES[$input]['tmp_name']) && count($_FILES[$input]['tmp_name']) > 0){
		  
		  $this->inputname = $input;
		  $this->uploadPatch = $uploadPatch;
		  $this->allowedTypes = $allowedTypes;
		  $this->maxSize = $maxSize; // Only here ##########################################################
		  // $this->maxInput = $maxInput;
		  
		  $this->tmp_name = $_FILES[$input]['tmp_name'];
		  $this->size = $_FILES[$input]['size'];
		  $this->type = $_FILES[$input]['type'];
		  
		  $this->Start();
	  }else
	  {
		  $this->error = "unset";  
		  $this->progress = false;
	   	  $this->size = 0;
		  $this->type = "invalid";
		  $this->name = "invalid";
		  $this->delete = true;
		  $this->tmp_name = "invalid";
	  }
	  
    }
	
	public function error(){ return $this->error; }
	
	public function name(){ return $this->name; }
	
	public function size(){ return $this->size; }
	
	public function progress(){ return $this->progress; }
	
	public function tmp_name(){ return $this->tmp_name; }
	
	public function links(){ return $this->full_patch; }
	
	public function delete(){
		if($this->progress == false || $this->error != NULL){
			return true;
		}else{
			
			foreach($this->name as $k => $v){
				if(file_exists($this->uploadPatch."/".$v)){
					unlink ($this->uploadPatch."/".$v);
				}
			}
			
			return true;
		}
	}
	
	private function Start(){
		
		$this->CheckTypes();
		$this->CheckSizes();
		$this->CheckErrors();
		
		if($this->error == NULL){
			
			$this->UploadFiles();
		
		}
         
	}
    
	private function CheckTypes(){
		
		foreach($_FILES[$this->inputname]['type'] as $k => $v):
		    
			 $r1rr = explode(".", $_FILES[$this->inputname]['name'][$k]);
	         $ext =  strtolower(end($r1rr));
	         
			if(in_array($ext,$this->SpicalFormats) && validate_image($_FILES[$this->inputname]['tmp_name'][$k]) === false){
					$this->error .= "Invalid File <b>Type</b> {".$_FILES[$this->inputname]['name'][$k]." - type = (.".$ext.")}"."\n";
					$this->progress = false;
			}
			else if(is_array($this->allowedTypes) && !in_array($ext, $this->allowedTypes)){
				$this->error .= "Invalid File <b>Type</b> {".$_FILES[$this->inputname]['name'][$k]." - type = (.".$ext.")}"."\n";
				$this->progress = false;
			}
		endforeach;
	
	}
	
	private function CheckSizes(){
		
		foreach($_FILES[$this->inputname]['size'] as $k => $v):
		    if($v > $this->maxSize){
				$this->error .= "Invalid File <b>Size</b> {".$_FILES[$this->inputname]['name'][$k]." - size = (".$v.")}"."\n";
				$this->progress = false;
			}
		endforeach;
		
	}
	
	private function CheckErrors(){
		
		foreach($_FILES[$this->inputname]['error'] as $k => $v):
		    if($v > 0){
				$this->error .= "Invalid File Containe Error {".$_FILES[$this->inputname]['name'][$k]." - error = (".$v.")}"."\n";
				$this->progress = false;
			}
		endforeach;
		
	}
	
	private function UploadFiles(){
	//	$Z = 0;
	//	print $_FILES[$this->inputname]['type'][$Z];
		$this->RenameFiles();
		$this->DoUpload();
	}
		
	private function RenameFiles(){
		
		$Z=0;
		
		for($i=0; $i<count($_FILES[$this->inputname]['name']); $i++){
			
			$base = date("d-m-Y")."_";
			
			$r1 = explode(".", $_FILES[$this->inputname]['name'][$Z]);
	        $ext =  end($r1);
			
			//////
			
			for($xx=0; $xx<=10000000; $xx++){
				$length = rand(10,150);
				$RoundChares = '0123456789abcdefghijklmnopqrstuvwxyzQWERTYUIOPLKJHGFDSAZXCVBNM';
				$string = "";
				
				for ($p = 0; $p < $length; $p++) {
				//disable notice errors for this action...
				$vl = $RoundChares[mt_rand(0,strlen($RoundChares)-1)];
				$string .= $vl;
				}
			
				$new_name = $base.$string.'.'.$ext;
			
				if(!file_exists($this->uploadPatch.'/'.$new_name) && !in_array($new_name,$this->name)){
					$this->name[] = $new_name;
					$this->full_patch[] = $this->uploadPatch.'/'.$new_name;
					break;
				}
			}
			
			//////
			
			$Z++;
		
		}
		
	}
	
	private function DoUpload(){
		foreach($_FILES[$this->inputname]['tmp_name'] as $k => $v){
			if(@copy($v,$this->uploadPatch."/".$this->name[$k])){
				$this->progress = true;
			}
		}
		$this->progress = true;
		return $this->progress;
	}
}
?>