@extends('layouts.admin')

@section('title', 'Appointments')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-yellow-400">Appointments</h1>
    </div>

    <div class="bg-black shadow-xl rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-yellow-400/20">
            <thead class="bg-yellow-400/10">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Service</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Date & Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-yellow-400/20 text-yellow-100">
                @forelse($appointments as $appointment)
                    <tr>
                        <td class="px-6 py-4">
                            <div>{{ $appointment->name }}</div>
                            <div class="text-sm text-yellow-400/60">{{ $appointment->email }}</div>
                            <div class="text-sm text-yellow-400/60">{{ $appointment->phone }}</div>
                        </td>
                        <td class="px-6 py-4">{{ $appointment->service }}</td>
                        <td class="px-6 py-4">
                            <div>{{ $appointment->preferred_date->format('M d, Y') }}</div>
                            <div class="text-sm text-yellow-400/60">{{ $appointment->preferred_time }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.appointments.updateStatus', $appointment) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" 
                                        onchange="this.form.submit()"
                                        class="bg-zinc-900 text-yellow-100 border border-yellow-400 rounded px-2 py-1 text-sm">
                                    <option value="pending" {{ $appointment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="completed" {{ $appointment->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-3">
                                <a href="{{ route('admin.appointments.show', $appointment) }}" 
                                   class="text-yellow-400 hover:text-yellow-300">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.appointments.destroy', $appointment) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-yellow-400/60">No appointments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $appointments->links() }}
    </div>
</div>
@endsection
