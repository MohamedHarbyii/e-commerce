<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\UploadedFile;

class ImageController extends Controller
{


    // ده الفولدر اللي هنخزن فيه
    public const FOLDER = 'images/';

    public static function store($image,$table_name)
    {
        return self::storeFile($image, self::FOLDER.$table_name);
    }
    public static function storeMultiple($images,$table_name)
    {
       return self::storeMultipleFiles($images,self::FOLDER.$table_name);
    }

    public static function update($image, $oldImage,$table_name)
    {
        return self::updateFile($image,  $oldImage, self::FOLDER.$table_name);
    }

    public static function destroy($imageName, $table_name)
    {
        self::deleteFile($imageName, self::FOLDER.$table_name);
    }
    public static function deleteImages($images, $table_name){
        self::deleteAllFiles($images,self::FOLDER.$table_name);
    }

    public static function compareImages(?string $oldImage, UploadedFile $file)
    {
        return self::compareFiles($oldImage, $file, self::FOLDER);
    }
}
