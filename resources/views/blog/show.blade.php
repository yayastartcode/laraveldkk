@extends('layouts.app')

@section('content')

    <main class="bg-black text-yellow-100 pt-[var(--header-height)]">
        <article class="container mx-auto px-6 py-20">
            <div class="max-w-4xl mx-auto">
                <div class="mb-8">
                    <img src="{{ $blog['image'] }}" 
                         alt="{{ $blog['title'] }}" 
                         class="w-full h-[400px] object-cover rounded-lg">
                </div>
                
                <div class="flex items-center text-yellow-100 text-sm mb-4">
                    <i class="far fa-calendar-alt mr-2"></i>
                    <span>{{ $blog['date'] }}</span>
                </div>
                
                <h1 class="text-4xl font-bold text-yellow-400 mb-8">{{ $blog['title'] }}</h1>
                
                <div class="prose prose-lg prose-invert prose-yellow max-w-none">
                    {!! $blog['content'] !!}
                </div>
                
                <div class="mt-12 pt-8 border-t border-yellow-400/20">
                    <a href="{{ route('blog.index') }}" 
                       class="text-yellow-400 hover:text-yellow-300 transition-colors inline-flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Blog
                    </a>
                </div>
            </div>
        </article>
    </main>

    
@endsection
