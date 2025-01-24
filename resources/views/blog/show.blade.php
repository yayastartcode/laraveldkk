@extends('layouts.app')

@section('content')
    <main class="bg-black text-yellow-100 pt-[var(--header-height)]">
        <article class="container mx-auto px-6 py-20">
            <div class="max-w-4xl mx-auto">
                <div class="mb-8">
                    <a href="{{ route('blog.index') }}" 
                       class="text-yellow-400 hover:text-yellow-300">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Blog
                    </a>
                </div>

                <h1 class="text-4xl font-bold text-yellow-400 mb-4">{{ $blog->title }}</h1>
                
                <div class="flex items-center text-yellow-400/60 mb-8">
                    <span>{{ $blog->created_at->format('F j, Y') }}</span>
                    @if($blog->category)
                        <span class="mx-2">•</span>
                        <span>{{ $blog->category->name }}</span>
                    @endif
                </div>

                @if($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" 
                         alt="{{ $blog->title }}"
                         class="w-full h-96 object-cover rounded-lg mb-8">
                @endif

                <div class="prose prose-lg prose-invert prose-yellow max-w-none">
                    {!! $blog->content !!}
                </div>
            </div>
        </article>
    </main>
@endsection
