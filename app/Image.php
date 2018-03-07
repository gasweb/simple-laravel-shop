<?php

namespace App;

use Illuminate\Database\Eloquent\Model,
    Illuminate\Support\Facades\Storage,
    Illuminate\Http\Request;

/**
 * Class Image
 * @package App
 * @property integer id
 * @property string description
 * @property string path_small
 * @property string path_large
 * @property string src_small
 * @property string src_large
 * @property string mime_type
 */
class Image extends Model
{
    /**
     * Method to upload image from form
     * @param Request $request
     * @return int|null
     */
    public static function uploadImage(Request $request)
    {
        $file = $request->file('category_image');
        $mime_type = $file->getMimeType();


        $file_path = self::getFilePath($mime_type);
        $small_file_path = self::getFilePath($mime_type);

        if (isset($file_path['directory']) && isset($file_path['file_name']) && isset($small_file_path['directory']) && isset($small_file_path['file_name']))
        {
            $file->move($file_path['directory'],$file_path['file_name']);

            try {

                /** @var \Imagick $imagick */
                $imagick = new \Imagick($file_path['directory'].DIRECTORY_SEPARATOR.$file_path['file_name']);

                $geometry = $imagick->getImageGeometry();
                $image_width = $geometry['width'];
                $image_height = $geometry['height'];

                $geometry_converter = function ($image_width_original, $image_height_original, $image_width, $image_height) {
                    if ($image_width_original < $image_width && $image_height_original < $image_height) {
                        return ['width' => $image_width_original, 'height' => $image_height_original];
                    } else {
                        $is_album = $image_width_original > $image_height_original ? true : false;
                        if ($is_album) {
                            $scale = $image_width_original > $image_width ? $image_width/$image_width_original : 1;
                        } else {
                            $scale = $image_height_original > $image_height ? $image_height/$image_height_original : 1;
                        }
                        return ['width' => $scale*$image_width_original, 'height' => $scale*$image_height_original];
                    }
                };

                $geometry = $geometry_converter($image_width, $image_height, 1200, 1200);
                $imagick->thumbnailImage($geometry['width'], $geometry['height'], false, true);
                $imagick->writeImage($file_path['directory'].DIRECTORY_SEPARATOR.$file_path['file_name']);

                $geometry = $geometry_converter($image_width, $image_height, 300, 300);
                $imagick->thumbnailImage($geometry['width'], $geometry['height'], false, true);
                $imagick->writeImage($small_file_path['directory'].DIRECTORY_SEPARATOR.$small_file_path['file_name']);

                $image = new Image();
                $image->path_small = $file_path['directory'].DIRECTORY_SEPARATOR.$file_path['file_name'];
                $image->path_large = $file_path['directory'].DIRECTORY_SEPARATOR.$file_path['file_name'];
                $image->src_large = $small_file_path['directory'].DIRECTORY_SEPARATOR.$small_file_path['file_name'];
                $image->src_small = $small_file_path['directory'].DIRECTORY_SEPARATOR.$small_file_path['file_name'];
                $image->mime_type = $mime_type;

                $image->save();

                return $image->id;

            } catch (\Exception $exception){
                return null;
            }
        }

        return null;
    }

    /**
     * Generates path to file and creates directories
     * @param string $mime_type
     * @return array
     */
    private static function getFilePath($mime_type="image/jpeg")
    {
        switch ($mime_type)
        {
            case "image/png":
                $extension = '.png';
                break;
            case "image/jpeg":
                $extension = '.jpg';
                break;
        }

        $root_relative = 'uploads/images/';

        $hash = sha1(mt_rand(1000, 5000).microtime()).sha1(mt_rand(10000, 50000).microtime());

        $dir_tree_array = str_split($hash, 2);
        $file_name = array_pop($dir_tree_array);

        $dir_path_relative = $root_relative.implode('/', $dir_tree_array);

        if (!file_exists($dir_path_relative))
        {
            mkdir($dir_path_relative, 0775, true);
            chmod($dir_path_relative, 0775);
        }

        return [
            'directory' => $dir_path_relative,
            'file_name' => $file_name.$extension
        ];
    }

    /**
     * @param Image $image
     * @return boolean
     */
    public static function destroyImage(Image $image)
    {
        try{
            Storage::delete($image->src_large);
            Storage::delete($image->src_small);
            $image->delete();
            return true;
        } catch (\Exception $exception){
            return false;
        }
    }
}
