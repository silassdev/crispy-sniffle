<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function submit(Request $req)
    {
        $data = $req->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Dev-friendly: log message or store in DB later
        \Log::info('Contact form submitted', $data);

        return back()->with('success','Message sent — thank you!');
    }
}
