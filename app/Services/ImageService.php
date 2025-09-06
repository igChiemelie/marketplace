<?php
namespace App\Services;

use Intervention\Image\ImageManagerStatic as Image;

class ImageService
{
    public static function resize($sourcePath, $destPath, $width = 800, $height = 600)
    {
        $img = Image::make($sourcePath)->fit($width, $height, function ($constraint) {
            $constraint->upsize();
        });
        $img->save($destPath, 85);
        return $destPath;
    }

    public static function watermark($sourcePath, $destPath, $watermarkPath, $position = 'bottom-right')
    {
        $img = Image::make($sourcePath);
        $watermark = Image::make($watermarkPath)->opacity(60);
        $img->insert($watermark, $position, 10, 10);
        $img->save($destPath, 90);
        return $destPath;
    }

    public static function crop($sourcePath, $destPath, $width, $height)
    {
        $img = Image::make($sourcePath)->crop($width, $height);
        $img->save($destPath, 90);
        return $destPath;
    }
}
