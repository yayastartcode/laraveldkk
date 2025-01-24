<!-- Contact Settings -->
<div class="bg-black rounded-lg shadow p-6 mb-6">
    <h2 class="text-xl font-semibold text-yellow-400 mb-4">Contact Information</h2>
    
    <form action="{{ route('admin.settings.updateContact') }}" method="POST">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-yellow-400 mb-2">Contact Email</label>
                <input type="email" 
                       name="contact_email" 
                       value="{{ $contact_email }}"
                       class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                @error('contact_email')
                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-yellow-400 mb-2">Contact Phone</label>
                <input type="text" 
                       name="contact_phone" 
                       value="{{ $contact_phone }}"
                       class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                @error('contact_phone')
                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-yellow-400 mb-2">Address</label>
                <textarea name="address" 
                          rows="3"
                          class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">{{ $address }}</textarea>
                @error('address')
                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit" 
                        class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-300">
                    Update Contact Information
                </button>
            </div>
        </div>
    </form>
</div>
