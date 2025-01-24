@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-2xl font-bold text-yellow-400 mb-6">Dashboard</h1>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Appointments -->
        <div class="bg-black rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-400/10 text-yellow-400">
                    <i class="fas fa-calendar-alt text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-yellow-400/60 text-sm">Total Appointments</p>
                    <p class="text-2xl font-semibold text-yellow-400">{{ $totalAppointments }}</p>
                </div>
            </div>
        </div>

        <!-- Total Contacts -->
        <div class="bg-black rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-400/10 text-yellow-400">
                    <i class="fas fa-envelope text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-yellow-400/60 text-sm">Total Messages</p>
                    <p class="text-2xl font-semibold text-yellow-400">{{ $totalContacts }}</p>
                </div>
            </div>
        </div>

        <!-- Total Blogs -->
        <div class="bg-black rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-400/10 text-yellow-400">
                    <i class="fas fa-newspaper text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-yellow-400/60 text-sm">Total Blog Posts</p>
                    <p class="text-2xl font-semibold text-yellow-400">{{ $totalBlogs }}</p>
                </div>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="bg-black rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-400/10 text-yellow-400">
                    <i class="fas fa-folder text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-yellow-400/60 text-sm">Total Categories</p>
                    <p class="text-2xl font-semibold text-yellow-400">{{ $totalCategories }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Data Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Recent Appointments -->
        <div class="bg-black rounded-lg shadow">
            <div class="p-6 border-b border-yellow-400/20">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-yellow-400">Recent Appointments</h2>
                    <a href="{{ route('admin.appointments.index') }}" class="text-yellow-400 hover:text-yellow-300 text-sm">
                        View All <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($recentAppointments->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentAppointments as $appointment)
                            <div class="flex justify-between items-start pb-4 last:pb-0 last:border-b-0 border-b border-yellow-400/10">
                                <div>
                                    <h3 class="text-yellow-400 font-medium">{{ $appointment->name }}</h3>
                                    <p class="text-sm text-yellow-400/60">{{ $appointment->service }}</p>
                                    <p class="text-xs text-yellow-400/60">{{ $appointment->preferred_date->format('M d, Y') }} at {{ $appointment->preferred_time }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($appointment->status === 'pending') bg-yellow-400/10 text-yellow-400
                                    @elseif($appointment->status === 'confirmed') bg-green-400/10 text-green-400
                                    @elseif($appointment->status === 'completed') bg-blue-400/10 text-blue-400
                                    @else bg-red-400/10 text-red-400
                                    @endif">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-yellow-400/60 text-center">No recent appointments</p>
                @endif
            </div>
        </div>

        <!-- Recent Contact Messages -->
        <div class="bg-black rounded-lg shadow">
            <div class="p-6 border-b border-yellow-400/20">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-yellow-400">Recent Messages</h2>
                    <a href="{{ route('admin.contacts.index') }}" class="text-yellow-400 hover:text-yellow-300 text-sm">
                        View All <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($recentContacts->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentContacts as $contact)
                            <div class="flex justify-between items-start pb-4 last:pb-0 last:border-b-0 border-b border-yellow-400/10">
                                <div>
                                    <h3 class="text-yellow-400 font-medium">{{ $contact->name }}</h3>
                                    <p class="text-sm text-yellow-400/60">{{ $contact->subject }}</p>
                                    <p class="text-xs text-yellow-400/60">{{ $contact->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($contact->status === 'unread') bg-yellow-400/10 text-yellow-400
                                    @elseif($contact->status === 'read') bg-blue-400/10 text-blue-400
                                    @else bg-green-400/10 text-green-400
                                    @endif">
                                    {{ ucfirst($contact->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-yellow-400/60 text-center">No recent messages</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
