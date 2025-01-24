@extends('layouts.admin')

@section('title', 'View Appointment')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-yellow-400">View Appointment</h1>
        <a href="{{ route('admin.appointments.index') }}" 
           class="text-yellow-400 hover:text-yellow-300">
            <i class="fas fa-arrow-left mr-2"></i>Back to Appointments
        </a>
    </div>

    <div class="bg-black shadow-xl rounded-lg overflow-hidden p-6 space-y-6">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <h2 class="text-lg font-semibold text-yellow-400 mb-2">Personal Information</h2>
                <div class="space-y-3 text-yellow-100">
                    <div>
                        <span class="text-yellow-400/60">Name:</span>
                        <span class="ml-2">{{ $appointment->name }}</span>
                    </div>
                    <div>
                        <span class="text-yellow-400/60">Email:</span>
                        <span class="ml-2">{{ $appointment->email }}</span>
                    </div>
                    <div>
                        <span class="text-yellow-400/60">Phone:</span>
                        <span class="ml-2">{{ $appointment->phone }}</span>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-yellow-400 mb-2">Appointment Details</h2>
                <div class="space-y-3 text-yellow-100">
                    <div>
                        <span class="text-yellow-400/60">Service:</span>
                        <span class="ml-2">{{ $appointment->service }}</span>
                    </div>
                    <div>
                        <span class="text-yellow-400/60">Preferred Date:</span>
                        <span class="ml-2">{{ $appointment->preferred_date->format('M d, Y') }}</span>
                    </div>
                    <div>
                        <span class="text-yellow-400/60">Preferred Time:</span>
                        <span class="ml-2">{{ $appointment->preferred_time }}</span>
                    </div>
                    <div>
                        <span class="text-yellow-400/60">Status:</span>
                        <span class="ml-2">
                            <form action="{{ route('admin.appointments.updateStatus', $appointment) }}" 
                                  method="POST" 
                                  class="inline">
                                @csrf
                                @method('PATCH')
                                <select name="status" 
                                        onchange="this.form.submit()"
                                        class="bg-zinc-900 text-yellow-100 border border-yellow-400 rounded px-2 py-1">
                                    <option value="pending" {{ $appointment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="completed" {{ $appointment->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        @if($appointment->message)
            <div class="mt-6">
                <h2 class="text-lg font-semibold text-yellow-400 mb-2">Message</h2>
                <div class="bg-zinc-900 rounded p-4 text-yellow-100">
                    {{ $appointment->message }}
                </div>
            </div>
        @endif

        <div class="flex justify-between items-center mt-6 pt-6 border-t border-yellow-400/20">
            <div class="text-sm text-yellow-400/60">
                Created: {{ $appointment->created_at->format('M d, Y H:i') }}
            </div>
            <form action="{{ route('admin.appointments.destroy', $appointment) }}" 
                  method="POST" 
                  onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Delete Appointment
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
