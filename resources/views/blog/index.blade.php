@extends('layouts.app')

@section('content')


    <main class="bg-black text-yellow-100 pt-[var(--header-height)]">
        <div class="container mx-auto px-6 py-20">
            <h1 class="text-4xl font-bold text-center text-yellow-400 mb-12">Our Blog</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($blogs as $blog)
                <article class="bg-zinc-900 rounded-lg overflow-hidden hover:transform hover:scale-105 transition-transform duration-300">
                    <img src="{{ $blog['image'] }}" 
                         alt="{{ $blog['title'] }}" 
                         class="w-full h-48 object-cover">
                         
                    <div class="p-6">
                        <div class="flex items-center text-yellow-100 text-sm mb-3">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>{{ $blog['date'] }}</span>
                        </div>
                        
                        <h2 class="text-xl font-semibold text-yellow-400 mb-3">{{ $blog['title'] }}</h2>
                        <p class="text-yellow-100 mb-4">{{ $blog['excerpt'] }}</p>
                        
                        <a href="{{ route('blog.show', $blog['slug']) }}" 
                           class="text-yellow-400 hover:text-yellow-300 transition-colors inline-flex items-center">
                            Read More 
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </main>

@endsection
