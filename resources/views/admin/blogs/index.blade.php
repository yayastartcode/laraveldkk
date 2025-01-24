@extends('layouts.admin')

@section('title', 'Blog Posts')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-yellow-400">Blog Posts</h1>
        <a href="{{ route('admin.blogs.create') }}" 
           class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-300">
            <i class="fas fa-plus mr-2"></i>New Post
        </a>
    </div>

    <div class="bg-black rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-yellow-400/20 text-yellow-400">
            <thead class="bg-zinc-900">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-yellow-400/20">
                @foreach($blogs as $blog)
                <tr>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <img src="{{ Storage::url($blog->image) }}" 
                                 alt="{{ $blog->title }}" 
                                 class="h-10 w-10 rounded object-cover mr-3">
                            {{ $blog->title }}
                        </div>
                    </td>
                    <td class="px-6 py-4">{{ $blog->category->name ?? 'Uncategorized' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $blog->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($blog->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">{{ $blog->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.blogs.edit', $blog) }}" 
                               class="text-yellow-400 hover:text-yellow-300">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $blogs->links() }}
    </div>
@endsection
