<?php

namespace App\Http\Traits;

//SE DEBE INSTALAR "INTERVENTION IMAGE"
//composer require intervention/image
use Intervention\Image\Facades\Image;

//PARA EL TRATAMIENTO DE IMAGENES
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait SetImageTrait {
    public function setImage($foto, $path){		
        if($foto){			            			
            $imageName = Str::random(20).'.png';
            $image = Image::make($foto)->encode('png', 75);
            $image->resize(466, 350, function($constraint){
                $constraint->upsize();
            });
            Storage::disk('public')->put($path.'/'.$imageName, $image->stream());            
            return $imageName;

        }
        else{
            return false;
        }

    } 
}