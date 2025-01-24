@extends('layouts.admin')

@section('title', 'Site Settings')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold text-yellow-400 mb-6">Site Settings</h1>

    <!-- Logo Settings -->
    <div class="bg-black rounded-lg shadow p-6 mb-6">
        <h2 class="text-xl font-semibold text-yellow-400 mb-4">Logo Settings</h2>
        
        @if($logo)
        <div class="mb-4">
            <img src="{{ asset('storage/' . $logo) }}" alt="Current Logo" class="max-h-20">
        </div>
        @endif

        <form action="{{ route('admin.settings.updateLogo') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-yellow-400 mb-2">Site Logo</label>
                    <input type="file" 
                           name="logo" 
                           accept="image/*"
                           required
                           class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    @error('logo')
                        <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button type="submit" 
                            class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-300">
                        Update Logo
                    </button>
                </div>
            </div>
        </form>
    </div>

    @include('admin.settings.partials.contact')
    @include('admin.settings.partials.social')

    <!-- Navigation Settings -->
    <div class="bg-black rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-yellow-400 mb-4">Navigation Settings</h2>
        
        <form action="{{ route('admin.settings.updateNavigation') }}" method="POST" id="navigationForm">
            @csrf
            <div class="space-y-4" id="navigationItems">
                @foreach($navigation as $index => $item)
                <div class="flex items-center space-x-4 navigation-item">
                    <div class="flex-1">
                        <input type="text" 
                               name="navigation[{{ $index }}][label]" 
                               value="{{ $item['label'] }}" 
                               placeholder="Label"
                               required
                               class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    <div class="flex-1">
                        <input type="text" 
                               name="navigation[{{ $index }}][url]" 
                               value="{{ $item['url'] }}" 
                               placeholder="URL"
                               required
                               class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    <div class="w-20">
                        <input type="number" 
                               name="navigation[{{ $index }}][order]" 
                               value="{{ $item['order'] ?? $index }}" 
                               placeholder="Order"
                               required
                               class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    <div>
                        <button type="button" 
                                onclick="removeNavItem(this)"
                                class="text-red-400 hover:text-red-300">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-4 space-x-4">
                <button type="button" 
                        onclick="addNavItem()"
                        class="bg-zinc-700 text-yellow-400 px-4 py-2 rounded hover:bg-zinc-600">
                    Add Item
                </button>
                <button type="submit" 
                        class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-300">
                    Save Navigation
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function addNavItem() {
    const index = document.querySelectorAll('.navigation-item').length;
    const template = `
        <div class="flex items-center space-x-4 navigation-item">
            <div class="flex-1">
                <input type="text" 
                       name="navigation[${index}][label]" 
                       placeholder="Label"
                       required
                       class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>
            <div class="flex-1">
                <input type="text" 
                       name="navigation[${index}][url]" 
                       placeholder="URL"
                       required
                       class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>
            <div class="w-20">
                <input type="number" 
                       name="navigation[${index}][order]" 
                       value="${index}"
                       placeholder="Order"
                       required
                       class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>
            <div>
                <button type="button" 
                        onclick="removeNavItem(this)"
                        class="text-red-400 hover:text-red-300">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `;
    
    document.getElementById('navigationItems').insertAdjacentHTML('beforeend', template);
}

function removeNavItem(button) {
    button.closest('.navigation-item').remove();
    // Reorder the remaining items
    document.querySelectorAll('.navigation-item').forEach((item, index) => {
        item.querySelectorAll('input').forEach(input => {
            input.name = input.name.replace(/\[\d+\]/, `[${index}]`);
        });
    });
}
</script>
@endpush
@endsection
