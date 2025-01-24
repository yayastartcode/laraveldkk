@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-yellow-400">Categories</h1>
        <a href="{{ route('admin.categories.create') }}" 
           class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-300">
            <i class="fas fa-plus mr-2"></i>New Category
        </a>
    </div>

    <div class="bg-black rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-yellow-400/20">
            <thead class="bg-zinc-900">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Posts Count</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y text-white divide-yellow-400/20">
                @foreach($categories as $category)
                <tr>
                    <td class="px-6 py-4">{{ $category['name'] }}</td>
                    <td class="px-6 py-4">{{ $category['blogs_count'] }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.categories.edit', ['category' => $category['_id']]) }}" 
                               class="text-yellow-400 hover:text-yellow-300">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.categories.destroy', ['category' => $category['_id']]) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this category?');">
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
        {{ $categories->links() }}
    </div>
@endsection
