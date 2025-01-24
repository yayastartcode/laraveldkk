@extends('layouts.admin')

@section('title', 'View Message')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-yellow-400">View Message</h1>
        <a href="{{ route('admin.contacts.index') }}" 
           class="text-yellow-400 hover:text-yellow-300">
            <i class="fas fa-arrow-left mr-2"></i>Back to Messages
        </a>
    </div>

    <div class="bg-black shadow-xl rounded-lg overflow-hidden p-6 space-y-6">
        <div class="border-b border-yellow-400/20 pb-6">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-xl font-semibold text-yellow-400">{{ $contact->subject }}</h2>
                    <div class="mt-2 text-yellow-100">
                        From: <span class="text-yellow-400">{{ $contact->name }}</span>
                    </div>
                </div>
                <div class="text-right text-sm text-yellow-400/60">
                    {{ $contact->created_at->format('M d, Y H:i') }}
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-yellow-400 mb-2">Contact Information</h3>
                <div class="space-y-3 text-yellow-100">
                    <div>
                        <span class="text-yellow-400/60">Email:</span>
                        <span class="ml-2">{{ $contact->email }}</span>
                    </div>
                    <div>
                        <span class="text-yellow-400/60">Phone:</span>
                        <span class="ml-2">{{ $contact->phone }}</span>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-yellow-400 mb-2">Status</h3>
                <form action="{{ route('admin.contacts.updateStatus', $contact) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="status" 
                            onchange="this.form.submit()"
                            class="bg-zinc-900 text-yellow-100 border border-yellow-400 rounded px-3 py-2">
                        <option value="unread" {{ $contact->status === 'unread' ? 'selected' : '' }}>Unread</option>
                        <option value="read" {{ $contact->status === 'read' ? 'selected' : '' }}>Read</option>
                        <option value="replied" {{ $contact->status === 'replied' ? 'selected' : '' }}>Replied</option>
                    </select>
                </form>
            </div>
        </div>

        <div>
            <h3 class="text-lg font-semibold text-yellow-400 mb-2">Message</h3>
            <div class="bg-zinc-900 rounded p-4 text-yellow-100">
                {{ $contact->message }}
            </div>
        </div>

        <div class="flex justify-end pt-6 border-t border-yellow-400/20">
            <form action="{{ route('admin.contacts.destroy', $contact) }}" 
                  method="POST" 
                  onsubmit="return confirm('Are you sure you want to delete this message?');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Delete Message
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
