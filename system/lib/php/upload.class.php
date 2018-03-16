<?php
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

require_once SYSROOT.'lib/php/upload/SingalUploadClass'.EXT;

require_once SYSROOT.'lib/php/upload/UploadPatchFunction'.EXT;

require_once SYSROOT.'lib/php/upload/MltiInputClass'.EXT;

/*
 *  with this class you can upload any file in your server
 *  
 *   sfile() -> Signal File Upload
 *          
 *          ->progress() return upload status false or true
 *   
 *          ->name();  return new name after you upload your file
 *          
 *          ->error();  return error that happen during progress
 *          
 *          ->type();  return file type
 *          
 *          ->tmp_name(); return tmp_name
 *          
 *          ->dataurl();  return encode_base64 of this file
 *          
 *          
 *   usage Example:
 *          
 *          $this->upload->patch("content/images");
			
			$this->upload->maxsize('4MB');
			
			$this->upload->type(array("png","gif","jpg"));
			
			$image = $this->upload->sfile('image');
			
			$image = $this->upload->mfile('image');
 *   
 * 
 */

interface UploadBase{

   public function patch($patch);
   public function maxsize($size);
   public function type($types);
   public function sfile($filename);
   public function mfiles($inputname,$max_inputs_allow = NULL);
   public function mltiarray(array $filesnames);
   
	
}

class upload extends Lib_Controller implements UploadBase{
	
	private static $fpatch,$fmaxsize;
	private static $types = array('gif','jpeg','pjpeg','png',
	                              'pdf','zip','rar','txt' );
							  
							  
	
    public function __construct(){
		parent::__construct();
	}
	public function patch($patch){
		if(!file_exists($patch)){
			throw new Exception("Upload Folder Not Found");
		}else{
			self::$fpatch = $patch;
			return new upload_functions($patch);
		}
    }
    public function maxsize($size = NULL)
    {
		
    	$defaultMaxSize = (ini_get('post_max_size'));
		$defaultMaxSizeInNum = (int)$defaultMaxSize;
		$defaultMaxSizeInString = strtolower(str_replace((int)$defaultMaxSize,'',$defaultMaxSize));
		
		switch ($defaultMaxSizeInString)
		{
			case 'b':
				$MuthXrD = 1;
				$defaultMaxSize = $defaultMaxSizeInNum * $MuthXrD;
				$OpyusD = 'b';
				break;
			case 'k':
				$MuthXrD = 1000;
				$defaultMaxSize = $defaultMaxSizeInNum * $MuthXrD;
				$OpyusD = 'kb';
				break;
			case 'm':
				$MuthXrD = 1000 * 1000;
				$defaultMaxSize = $defaultMaxSizeInNum * $MuthXrD;
				$OpyusD = 'mb';
				break;
			case 'g':
				$MuthXrD = 1000 * 1000 * 1000;
				$defaultMaxSize = $defaultMaxSizeInNum * $MuthXrD;
				$OpyusD = 'gb';
				break;				
		}
		
		
		$size = (is_null($size))?$defaultMaxSize:$size;
		
		$sizeInNum = (int)$size;
		$sizeInString = (strtolower(str_replace((int)$size,'',$size))!=NULL)?strtolower(str_replace((int)$size,'',$size)):'b';
		
		switch ($sizeInString)
		{
			case 'b':
				$MuthXr = 1;
				self::$fmaxsize = $sizeInNum * $MuthXr;
				$Opyus = 'b';
				break;
			case 'kb':
				$MuthXr = 1000;
				self::$fmaxsize = $sizeInNum * $MuthXr;
				$Opyus = 'kb';
				break;
			case 'mb':
				$MuthXr = 1000 * 1000;
				self::$fmaxsize = $sizeInNum * $MuthXr;
				$Opyus = 'mb';
				break;
			case 'gb':
				$MuthXr = 1000 * 1000 * 1000;
				self::$fmaxsize = $sizeInNum * $MuthXr;
				$Opyus = 'gb';
				break;				
		}
		
		if(self::$fmaxsize > $defaultMaxSize)
		{
			throw new Exception("Your maxSize for upload.class must be lower than ".$defaultMaxSize/$MuthXrD.$OpyusD);
		}
		
		
		
		return self::$fmaxsize;
    	
	}
    
    public function type($types = NULL){
		if($types != NULL){
			
			if(is_string($types) && $types == "ALL"){self::$types = $types;}
			else if(is_array($types)){self::$types = $types;}
			else {throw new Exception("type input must be array or string equal to <b>ALL</b>");}
			return self::$types;
			
		}
		else
		{ 
			return self::$types; 
		}
    }
    public function sfile($filename){
   
		return new upload_single_file_functions($filename,self::$fpatch,self::$types,self::$fmaxsize);
    }
    public function mfiles($inputname,$max_inputs_allow = NULL){
    	
    	return new MultiInput($inputname,self::$fpatch,self::$types,self::$fmaxsize,$max_inputs_allow);
    }
    public function mltiarray(array $filesnames){
    }
}

?>