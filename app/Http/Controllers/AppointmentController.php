<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'service' => 'required|string|max:255',
            'preferred_date' => 'required|date|after:today',
            'preferred_time' => 'required|string',
            'message' => 'nullable|string|max:1000'
        ]);

        $validated['status'] = 'pending';
        
        Appointment::create($validated);

        return redirect()->back()
            ->with('success', 'Your appointment request has been submitted successfully. We will contact you shortly.');
    }
}
