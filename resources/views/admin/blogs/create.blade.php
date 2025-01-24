@extends('layouts.admin')

@section('title', 'Create Blog Post')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-yellow-400">Create Blog Post</h1>
            <a href="{{ route('admin.blogs.index') }}" 
               class="text-yellow-400 hover:text-yellow-300">
                <i class="fas fa-arrow-left mr-2"></i>Back to Posts
            </a>
        </div>

        <form action="{{ route('admin.blogs.store') }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="bg-black rounded-lg shadow p-6 space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-yellow-400 mb-2">Title</label>
                <input type="text" 
                       name="title" 
                       value="{{ old('title') }}" 
                       required 
                       class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                @error('title')
                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-yellow-400 mb-2">Category</label>
                <select name="category_id" 
                        required 
                        class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-yellow-400 mb-2">Featured Image</label>
                <input type="file" 
                       name="image" 
                       required 
                       accept="image/*"
                       class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                @error('image')
                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-yellow-400 mb-2">Excerpt</label>
                <textarea name="excerpt" 
                          rows="3" 
                          required 
                          class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-trix-editor 
                    name="content"
                    label="Content"
                    :value="old('content')"
                    :required="true"
                    class="h-96 text-white"
                />
                @error('content')
                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-yellow-400 mb-2">Tags (comma separated)</label>
                <input type="text" 
                       name="tags" 
                       value="{{ old('tags') }}" 
                       placeholder="tag1, tag2, tag3" 
                       class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                @error('tags')
                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-yellow-400 mb-2">Status</label>
                <select name="status" 
                        required 
                        class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                </select>
                @error('status')
                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-yellow-400 mb-2">Meta Description</label>
                <textarea name="meta_description" 
                          rows="2" 
                          class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">{{ old('meta_description') }}</textarea>
                @error('meta_description')
                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-yellow-400 mb-2">Meta Keywords</label>
                <input type="text" 
                       name="meta_keywords" 
                       value="{{ old('meta_keywords') }}" 
                       placeholder="keyword1, keyword2, keyword3" 
                       class="w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                @error('meta_keywords')
                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit" 
                        class="w-full bg-yellow-400 text-black py-3 rounded-lg font-semibold hover:bg-yellow-300 transition-colors">
                    Create Blog Post
                </button>
            </div>
        </form>
    </div>
@endsection
