<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        // For now, just return a success response
        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
