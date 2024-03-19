<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class PersonalityImageService
{
   /**
    * Resize the image to a maximum width and height and keep the aspect ratio.
    *
    * @param string $image
    * @param int $width
    * @return \Intervention\Image\Interfaces\ImageInterface
    */
    public function resizeImage(string $image, int $width = 500): \Intervention\Image\Interfaces\ImageInterface
    {
        $manager = new ImageManager(
            new Driver()
        );
        $img = $manager->read($image);

        $img->scaleDown(width: 500);

        return $img;
    }
}
