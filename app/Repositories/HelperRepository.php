<?php
namespace App\Repositories;
use Illuminate\Support\Facades\File;
use Illumintate\Support\Facades\UploadedFile;

class HelperRepository
{
    // Logical non crud
    function map_image($folder, $images) {
        $file_image = [];
        if($images != null) {
            foreach($images as $file) {
                // $images = uniqid().'-'.$file->getClientOriginalName();
                $images = $file->hashName();
                $file->move($folder, $images);
                $file_image[] = $images;
            }
        }
        return $file_image;
    }
}