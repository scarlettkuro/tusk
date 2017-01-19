<?php

namespace app\service;

/**
 * Description of ImageProccessor
 *
 * @author kuro
 */
class ImageProccessor {

   var $image;
   var $type;

   function __construct($filename) {
      $image_info = getimagesize($filename);
      $this->type = $image_info[2];
      if( $this->type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename) {
      if( $this->type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename);
      } elseif( $this->type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);
      } elseif( $this->type == IMAGETYPE_PNG ) {
         imagepng($this->image,$filename);
      }
   }
   
   function getWidth() {
      return imagesx($this->image);
   }
   
   function getHeight() {
      return imagesy($this->image);
   }
   
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      $ratio =  $this->getWidth() / $width;
      $scaled_height = min([$this->getheight(), $height* $ratio]);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $scaled_height);
      $this->image = $new_image;
   }
}
