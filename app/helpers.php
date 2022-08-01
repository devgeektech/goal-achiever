<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
//use Exception;

function uploadImageS3($request_file, $filename){     
    
    //Upload File to s3
    Storage::disk('s3')->put($filename, file_get_contents($request_file));
    $url = Storage::disk('s3')->url($filename);
    return $url;
   
        
}

// Check if image exists on aws s3 bucket
function isImageExistsOnAws($image){
    $exists = Storage::disk('s3')->has($image);
    return $exists;
}

// Delete image form s3 bucket
function deleteImageFromS3($file){
    Storage::disk('s3')->delete($file);
} 

?>