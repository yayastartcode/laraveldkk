@extends('layouts.app')

@section('content')
    <x-header :logo-text="'Dalbo Kencana Kreasi'" />
    
    <main class="bg-black text-yellow-100">
        <!-- Hero Section -->
        <section class="relative h-screen">
            <div class="swiper hero-swiper h-full">
                <div class="swiper-wrapper">
                    @foreach($heroSlides as $slide)
                    <div class="swiper-slide relative">
                        <img src="{{ $slide['image'] }}" 
                             alt="{{ $slide['title'] }}" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center">
                            <div class="container mx-auto px-6">
                                <h1 class="text-5xl md:text-6xl font-bold text-yellow-400 mb-4">
                                    {{ $slide['title'] }}
                                </h1>
                                <p class="text-xl md:text-2xl mb-8 max-w-2xl">
                                    {{ $slide['description'] }}
                                </p>
                                <a href="#contact" 
                                   class="bg-yellow-400 text-black px-8 py-3 rounded-lg font-semibold hover:bg-yellow-300 transition-colors inline-block">
                                    {{ $slide['buttonText'] }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>

        <x-about-section />
        
        <!-- Services Section -->
        <section id="services" class="bg-gradient-to-b from-black to-zinc-900 py-20">
            <div class="container mx-auto px-6">
                <h2 class="text-4xl font-bold text-center text-yellow-400 mb-4">Our Services</h2>
                <p class="text-center mb-12 text-yellow-100 max-w-3xl mx-auto">
                    Comprehensive automotive solutions tailored to your needs
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($services as $service)
                    <div class="bg-zinc-900 rounded-lg overflow-hidden hover:transform hover:scale-105 transition-transform duration-300">
                        <img src="{{ $service['image'] }}" alt="{{ $service['title'] }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-yellow-400 mb-3">{{ $service['title'] }}</h3>
                            <p class="mb-4">{{ $service['description'] }}</p>
                            <ul class="space-y-2">
                                @foreach($service['features'] as $feature)
                                <li>
                                    <i class="fas fa-check text-yellow-400 mr-2"></i>
                                    {{ $feature }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <x-appointment-section />
        <x-blog-section :blogs="$blogs" />
        <x-gallery-section :gallery="$gallery" />
        <x-testimonial-section :testimonials="$testimonials" />
        <x-contact-section />
    </main>

    <x-footer />
@endsection

@push('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script>
    // Hero Slider
    new Swiper('.hero-swiper', {
        loop: true,
        autoplay: {
            delay: 5000,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>
@endpush
