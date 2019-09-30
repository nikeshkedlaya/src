<?php

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
class Thumbnailbuilder
{

    private $imageResource;

    private $imageName;

    private $imageType;

    private const IMG_QUALITY = 100;

    public const THUMBNAIL_IMG_EXT = ".png";

    public const VIDEO_THUMBNAIL_SUFFIX = "_video_thumbnail";

    public const IMAGE_THUMBNAIL_SUFFIX = "_image_thumbnail";

    public function buildImageThumbnail(string $imagefilePath, int $width = 300, int $height = 300)
    {
        try {
            if (file_exists($imagefilePath)) {
                $this->createImgResource($imagefilePath)
                    ->resize($width, $height)
                    ->save();
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * will be used to build video thumbnail
     *
     * @param string $fileName
     * @param string $fileContainingFolder
     * @param string $wdKey
     */
    public function buildVideoThumbnail(string $videofilePath)
    {
        try {
            if (file_exists($videofilePath)) {
                $thumnailImagePath = $this->getFileNameWithoutExt($videofilePath);
                $thumnailImagePath .= SELF::VIDEO_THUMBNAIL_SUFFIX . self::THUMBNAIL_IMG_EXT;
                $ffmpegCmd = "ffmpeg -i {$videofilePath} -deinterlace -an -ss 5 -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg {$thumnailImagePath} > /dev/null 2>/dev/null &";
                exec($ffmpegCmd);
                $this->buildImageThumbnail($thumnailImagePath);
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    private function getFileNameWithoutExt(string $fileName): string
    {
        return substr($fileName, 0, strrpos($fileName, "."));
    }

    private function createImgResource($filename)
    {
        $this->imageName = $filename;
        $image_info = getimagesize($this->imageName);
        $this->imageType = $image_info[2];
        if ($this->imageType == IMAGETYPE_JPEG) {
            $this->imageResource = imagecreatefromjpeg($this->imageName);
        } elseif ($this->imageType == IMAGETYPE_GIF) {
            $this->imageResource = imagecreatefromgif($this->imageName);
        } elseif ($this->imageType == IMAGETYPE_PNG) {
            $this->imageResource = imagecreatefrompng($this->imageName);
        }
        return $this;
    }

    private function save()
    {
        $thumbnailImageName = $this->getFileNameWithoutExt($this->imageName) . self::IMAGE_THUMBNAIL_SUFFIX . self::THUMBNAIL_IMG_EXT;
        if ($this->imageType == IMAGETYPE_JPEG) {
            imagejpeg($this->imageResource, $thumbnailImageName, self::IMG_QUALITY);
        } elseif ($this->imageType == IMAGETYPE_GIF) {
            imagegif($this->imageResource, $thumbnailImageName);
        } elseif ($this->imageType == IMAGETYPE_PNG) {
            imagepng($this->imageResource, $thumbnailImageName, 9);
        }
        chmod($thumbnailImageName, 0777);
    }

    // public function output($image_type = IMAGETYPE_JPEG)
    // {
    // if ($image_type == IMAGETYPE_JPEG) {
    // imagejpeg($this->image);
    // } elseif ($image_type == IMAGETYPE_GIF) {
    
    // imagegif($this->image);
    // } elseif ($image_type == IMAGETYPE_PNG) {
    
    // imagepng($this->image);
    // }
    // }
    public function getWidth()
    {
        return imagesx($this->imageResource);
    }

    public function getHeight()
    {
        return imagesy($this->imageResource);
    }

    public function resizeToHeight($height)
    {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }

    public function resizeToWidth($width)
    {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width, $height);
    }

    public function scale($scale)
    {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getheight() * $scale / 100;
        $this->resize($width, $height);
    }

    public function resize(int $width, int $height)
    {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->imageResource, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->imageResource = $new_image;
        return $this;
    }
}
    