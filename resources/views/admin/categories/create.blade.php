@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-yellow-400">Create Category</h1>
            <a href="{{ route('admin.categories.index') }}" 
               class="text-yellow-400 hover:text-yellow-300">
                <i class="fas fa-arrow-left mr-2"></i>Back to Categories
            </a>
        </div>

        <form action="{{ route('admin.categories.store') }}" 
              method="POST" 
              class="bg-black rounded-lg shadow p-6 space-y-6">
            @csrf

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
                <label class="block text-sm font-medium text-yellow-400 mb-2">Description</label>
                <textarea name="description" 
                          rows="4" 
                          class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-yellow-400 text-black px-6 py-2 rounded hover:bg-yellow-300">
                    Create Category
                </button>
            </div>
        </form>
    </div>
@endsection
