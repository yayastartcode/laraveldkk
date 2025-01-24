@extends('layouts.admin')

@section('title', 'Create Testimonial')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-yellow-400">Create Testimonial</h1>
        <a href="{{ route('admin.testimonials.index') }}" 
           class="text-yellow-400 hover:text-yellow-300">
            <i class="fas fa-arrow-left mr-2"></i>Back to Testimonials
        </a>
    </div>

    <form action="{{ route('admin.testimonials.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="bg-black rounded-lg shadow p-6 space-y-6">
        @csrf

        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500 text-red-500 p-4 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <label class="block text-sm font-medium text-yellow-400 mb-2">Name</label>
            <input type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            @error('name')
                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-yellow-400 mb-2">Position</label>
            <input type="text" 
                   name="position" 
                   value="{{ old('position') }}" 
                   required 
                   class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            @error('position')
                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-yellow-400 mb-2">Company (Optional)</label>
            <input type="text" 
                   name="company" 
                   value="{{ old('company') }}" 
                   class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            @error('company')
                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-yellow-400 mb-2">Content</label>
            <textarea name="content" 
                      rows="4" 
                      required
                      class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">{{ old('content') }}</textarea>
            @error('content')
                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-yellow-400 mb-2">Profile Image</label>
            <input type="file" 
                   name="image" 
                   accept="image/*"
                   required
                   class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            <p class="mt-1 text-sm text-yellow-400/60">Recommended size: 200x200px</p>
            @error('image')
                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-yellow-400 mb-2">Rating</label>
            <div class="flex space-x-4">
                @for($i = 1; $i <= 5; $i++)
                    <label class="inline-flex items-center">
                        <input type="radio" 
                               name="rating" 
                               value="{{ $i }}" 
                               {{ old('rating') == $i ? 'checked' : '' }}
                               class="form-radio text-yellow-400 focus:ring-yellow-400 bg-zinc-900">
                        <span class="ml-2 text-yellow-100">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</span>
                    </label>
                @endfor
            </div>
            @error('rating')
                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-yellow-400 mb-2">Order</label>
                <input type="number" 
                       name="order" 
                       value="{{ old('order', 0) }}" 
                       required 
                       min="0"
                       class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                @error('order')
                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-yellow-400 mb-2">Status</label>
                <label class="inline-flex items-center mt-2">
                    <input type="checkbox" 
                           name="is_active" 
                           value="1" 
                           {{ old('is_active', true) ? 'checked' : '' }}
                           class="rounded border-yellow-400 text-yellow-400 focus:ring-yellow-400 bg-zinc-900">
                    <span class="ml-2 text-yellow-100">Active</span>
                </label>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" 
                    class="bg-yellow-400 text-black px-6 py-2 rounded hover:bg-yellow-300">
                Create Testimonial
            </button>
        </div>
    </form>
</div>
@endsection
