<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Mail\ContactFormMail;

use Illuminate\Support\Facades\Mail;
class ContactController extends Controller
{
 

    public function email(Request $request)
    {
        $formData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Mail::to('ricojajeb.tayobong@gmail.com')->send(new ContactFormMail($formData));

        return redirect()->back()->with('success', 'Email sent successfully!');
    }

}
