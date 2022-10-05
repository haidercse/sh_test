<?php 

namespace App\Services;

use Illuminate\Http\Client\Request;

class FileUpload{
    public function upload($request,$fileNmae, $publicPath){

        $image = $request->file($fileNmae);
        $reImage = time().'.'.$image->getClientOriginalExtension();
        $dest = public_path($publicPath);
        $image->move($dest,$reImage);

        return $reImage;
    }

    
}