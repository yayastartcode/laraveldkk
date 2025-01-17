<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'service_type' => 'required|string|in:karoseri,engine,body',
            'date' => 'required|date',
            'message' => 'nullable|string',
        ]);

        // For now, just return a success response
        return back()->with('success', 'Appointment request received. We will contact you shortly.');
    }
}
