@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-yellow-400">Contact Messages</h1>
    </div>

    <div class="bg-black shadow-xl rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-yellow-400/20">
            <thead class="bg-yellow-400/10">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">From</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Subject</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-yellow-400/20 text-yellow-100">
                @forelse($contacts as $contact)
                    <tr class="{{ $contact->status === 'unread' ? 'bg-yellow-400/5' : '' }}">
                        <td class="px-6 py-4">
                            <div>{{ $contact->name }}</div>
                            <div class="text-sm text-yellow-400/60">{{ $contact->email }}</div>
                            <div class="text-sm text-yellow-400/60">{{ $contact->phone }}</div>
                        </td>
                        <td class="px-6 py-4">{{ $contact->subject }}</td>
                        <td class="px-6 py-4">
                            {{ $contact->created_at->format('M d, Y H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.contacts.updateStatus', $contact) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" 
                                        onchange="this.form.submit()"
                                        class="bg-zinc-900 text-yellow-100 border border-yellow-400 rounded px-2 py-1 text-sm">
                                    <option value="unread" {{ $contact->status === 'unread' ? 'selected' : '' }}>Unread</option>
                                    <option value="read" {{ $contact->status === 'read' ? 'selected' : '' }}>Read</option>
                                    <option value="replied" {{ $contact->status === 'replied' ? 'selected' : '' }}>Replied</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-3">
                                <a href="{{ route('admin.contacts.show', $contact) }}" 
                                   class="text-yellow-400 hover:text-yellow-300">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.contacts.destroy', $contact) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this message?');">
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
                        <td colspan="5" class="px-6 py-4 text-center text-yellow-400/60">No messages found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $contacts->links() }}
    </div>
</div>
@endsection
