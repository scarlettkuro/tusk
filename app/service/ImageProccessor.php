<?php

namespace app\service;

/**
 * Description of ImageProccessor
 *
 * @author kuro
 */
class ImageProccessor {

    private $image;
    private $type;
    private $width;
    private $height;
            
    public function __construct($filename) {
        
        $info = getimagesize($filename);
        $this->width = $info[0];
        $this->height = $info[1];
        $this->type = $info[2];
        
        switch ($this->type) {
            case IMAGETYPE_JPEG: $this->image = imagecreatefromjpeg($filename);
            break;
            case IMAGETYPE_GIF: $this->image = imagecreatefromgif($filename);
            break;
            case IMAGETYPE_PNG: $this->image = imagecreatefrompng($filename);
            break;
            default: break;
        }
    }
   
    public function save($filename) {
       
        switch ($this->type) {
            case IMAGETYPE_JPEG: imagejpeg($this->image,$filename);
            break;
            case IMAGETYPE_GIF: imagegif($this->image,$filename);
            break;
            case IMAGETYPE_PNG: imagepng($this->image,$filename);
            break;
            default: break;
        }
    }
   
    public function resize($width, $height) {
        $ratio =  $this->width / $width;
        $scaled_height = min([$this->height, $height * $ratio]);
        $new_scaled_height =  $scaled_height / $ratio;
        $new_image = imagecreatetruecolor($width, $new_scaled_height);
        imagecopyresized($new_image, $this->image, 0, 0, 0, 0, $width, $new_scaled_height, $this->width, $scaled_height);
        $this->image = $new_image;
    }
}
