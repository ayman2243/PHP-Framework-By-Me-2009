<?php
class thumb{
   
   private static $image;
   private static $image_type;
 
   function load($filename) {
      $image_info = getimagesize($filename);
      self::$image_type = $image_info[2];
      if( self::$image_type == IMAGETYPE_JPEG ) {
         self::$image = imagecreatefromjpeg($filename);
      } elseif( self::$image_type == IMAGETYPE_GIF ) {
         self::$image = imagecreatefromgif($filename);
      } elseif( self::$image_type == IMAGETYPE_PNG ) {
         self::$image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg(self::$image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif(self::$image,$filename);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng(self::$image,$filename);
      }   
      if( $permissions != null) {
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg(self::$image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif(self::$image);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng(self::$image);
      }   
   }
   function getWidth() {
      return imagesx(self::$image);
   }
   function getHeight() {
      return imagesy(self::$image);
   }
   function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100; 
      $this->resize($width,$height);
   }
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, self::$image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      self::$image = $new_image;   
   }      
}
?>