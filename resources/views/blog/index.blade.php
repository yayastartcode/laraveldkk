@extends('layouts.app')

@section('content')
    <main class="bg-black text-yellow-100 pt-[var(--header-height)]">
        <div class="container mx-auto px-6 py-20">
            <h1 class="text-4xl font-bold text-yellow-400 mb-12">Latest News & Articles</h1>
            
            @if($blogs->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($blogs as $blog)
                        <article class="bg-zinc-900 rounded-lg overflow-hidden shadow-lg">
                            @if($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" 
                                     alt="{{ $blog->title }}"
                                     class="w-full h-48 object-cover">
                            @endif
                            <div class="p-6">
                                <h2 class="text-xl font-bold text-yellow-400 mb-2">
                                    <a href="{{ route('blog.show', $blog->slug) }}" 
                                       class="hover:text-yellow-300">
                                        {{ $blog->title }}
                                    </a>
                                </h2>
                                <p class="text-yellow-400/60 text-sm mb-4">
                                    {{ $blog->created_at->format('F j, Y') }}
                                </p>
                                <p class="text-yellow-100/80 mb-4">
                                    {{ Str::limit(strip_tags($blog->content), 150) }}
                                </p>
                                <a href="{{ route('blog.show', $blog->slug) }}" 
                                   class="inline-block text-yellow-400 hover:text-yellow-300">
                                    Read More <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $blogs->links() }}
                </div>
            @else
                <p class="text-center text-yellow-400/60">No blog posts found.</p>
            @endif
        </div>
    </main>
@endsection
