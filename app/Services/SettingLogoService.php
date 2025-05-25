<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingLogoService
{
   

    public function handleImageUpload(Request $request)
    {
        // gin ccheck kon mayda image file ba
        if ($request->hasFile('system_logo') && $request->file('system_logo')->isValid()) {
            
            $image = $request->file('system_logo');

            // tapos ini amo an nag aayad han unique name para han image
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //tapos amo liwat ini kun ngain ig store an image
            $image->move(public_path('storage/output'), $imageName); 
            return $imageName;
        }

        return null;  // If no image is uploaded, return null
    }

 
    
 
}
