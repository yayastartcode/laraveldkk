<!-- Social Media Settings -->
<div class="bg-black rounded-lg shadow p-6 mb-6">
    <h2 class="text-xl font-semibold text-yellow-400 mb-4">Social Media Links</h2>
    
    <form action="{{ route('admin.settings.updateSocial') }}" method="POST">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-yellow-400 mb-2">Facebook</label>
                <input type="url" 
                       name="social_media[facebook]" 
                       value="{{ $social_media['facebook'] ?? '' }}"
                       placeholder="https://facebook.com/your-page"
                       class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-yellow-400 mb-2">Instagram</label>
                <input type="url" 
                       name="social_media[instagram]" 
                       value="{{ $social_media['instagram'] ?? '' }}"
                       placeholder="https://instagram.com/your-profile"
                       class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-yellow-400 mb-2">YouTube</label>
                <input type="url" 
                       name="social_media[youtube]" 
                       value="{{ $social_media['youtube'] ?? '' }}"
                       placeholder="https://youtube.com/your-channel"
                       class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>
            <div>
                <button type="submit" 
                        class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-300">
                    Update Social Media Links
                </button>
            </div>
        </div>
    </form>
</div>
