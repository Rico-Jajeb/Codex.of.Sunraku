<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CodexImageService
{
   

    public function handleImageUpload(Request $request)
    {
        // gin ccheck kon mayda image file ba
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            
            $image = $request->file('img');

            // tapos ini amo an nag aayad han unique name para han image
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //tapos amo liwat ini kun ngain ig store an image
            $image->move(public_path('storage/output'), $imageName); 
            return $imageName;
        }

        return null;  // If no image is uploaded, return null
    }

 
    
 
}
