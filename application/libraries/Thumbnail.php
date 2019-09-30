// <?php

/**
 * @created by Sandeep kosta <sandeep@kaholabs.com> on 10 Dec, 2014 5:30:55 PM
 *
 * Descripion:
 *
 * Security :
 *
 * Change History :-
 *
 *
 *
 *
 * @Audited by :-
 */
class Thumbnail {

//    private $image;
//    private $image_type;
//
//    public function load($filename) {
//        $image_info = getimagesize($filename);
//        $this->image_type = $image_info[2];
//        if ($this->image_type == IMAGETYPE_JPEG) {
//
//            $this->image = imagecreatefromjpeg($filename);
//        } elseif ($this->image_type == IMAGETYPE_GIF) {
//
//            $this->image = imagecreatefromgif($filename);
//        } elseif ($this->image_type == IMAGETYPE_PNG) {
//
//            $this->image = imagecreatefrompng($filename);
//        }
//    }
//
//    private function processImageFileByType() {
//        
//    }
//
//    public function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 100, $permissions = null) {
//        if ($image_type == IMAGETYPE_JPEG) {
//            imagejpeg($this->image, $filename, $compression);
//        } elseif ($image_type == IMAGETYPE_GIF) {
//            imagegif($this->image, $filename);
//        } elseif ($image_type == IMAGETYPE_PNG) {
//            imagepng($this->image, $filename);
//        }
//        if ($permissions != null) {
//            chmod($filename, $permissions);
//        }
//    }
//
//    public function output($image_type = IMAGETYPE_JPEG) {
//        if ($image_type == IMAGETYPE_JPEG) {
//            imagejpeg($this->image);
//        } elseif ($image_type == IMAGETYPE_GIF) {
//
//            imagegif($this->image);
//        } elseif ($image_type == IMAGETYPE_PNG) {
//
//            imagepng($this->image);
//        }
//    }
//
//    public function getWidth() {
//        return imagesx($this->image);
//    }
//
//    public function getHeight() {
//        return imagesy($this->image);
//    }
//
//    public function resizeToHeight($height) {
//        $ratio = $height / $this->getHeight();
//        $width = $this->getWidth() * $ratio;
//        $this->resize($width, $height);
//    }

//    public function resizeToWidth($width) {
//        $ratio = $width / $this->getWidth();
//        $height = $this->getheight() * $ratio;
//        $this->resize($width, $height);
//    }
//
//    public function scale($scale) {
//        $width = $this->getWidth() * $scale / 100;
//        $height = $this->getheight() * $scale / 100;
//        $this->resize($width, $height);
//    }
//
//    public function resize($width, $height) {
//        $new_image = imagecreatetruecolor($width, $height);
//        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
//        $this->image = $new_image;
//    }

    /**
     * will be used to build video thumbnail
     *
     * @param string $fileName
     * @param string $fileContainingFolder
     * @param string $wdKey
     */
//    public static function buildVideoThumbnail(string $videofilePath) {
//        try {
//            if (file_exists($videofilePath)) {
//                $thumnailImagePath = substr($videofilePath, 0, strrpos($videofilePath, "."));
//                $thumnailImagePath .= "_video_thumbnail.jpg";
//                $ffmpegCmd = "ffmpeg -i {$videofilePath} -deinterlace -an -ss 5 -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg {$thumnailImagePath} > /dev/null 2>/dev/null &";
//                exec($cmd);
//            }
//        } catch (Exception $e) {
//            $e->getMessage();
//        }
//    }

}
