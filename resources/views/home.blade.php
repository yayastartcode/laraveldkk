@extends('layouts.app')

@section('content')
    <main class="bg-black text-yellow-100">
        <!-- Hero Section -->
        <section class="relative h-screen">
            <div class="swiper hero-swiper h-full">
                <div class="swiper-wrapper">
                    @foreach($sliders as $slide)
                    <div class="swiper-slide relative">
                        <img src="{{ asset('storage/' . $slide->image) }}" 
                             alt="{{ $slide->title }}" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center">
                            <div class="container mx-auto px-6">
                                <h1 class="text-5xl md:text-6xl font-bold text-yellow-400 mb-4">
                                    {{ $slide->title }}
                                </h1>
                                <p class="text-xl md:text-2xl text-yellow-400/80 mb-8">
                                    {{ $slide->subtitle }}
                                </p>
                                @if($slide->button_text)
                                    <a href="{{ $slide->button_url }}" 
                                       class="inline-block bg-yellow-400 text-black px-8 py-3 rounded-lg text-lg font-semibold hover:bg-yellow-300 transition-colors">
                                        {{ $slide->button_text }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>
        <x-about-section />
        <x-services-section :services="$services" />
        <x-appointment-section />
        <x-blog-section :blogs="$blogs" />
        <x-gallery-section :gallery="$gallery" />
        
        <!-- Testimonials Section -->
        <section class="py-16 bg-zinc-900">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-yellow-400 mb-4">What Our Clients Say</h2>
                    <p class="text-yellow-400/60">Dengar apa kata klien kami tentang service Pt Dalbo Kencana Kreasi</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($testimonials as $testimonial)
                    <div class="bg-black p-6 rounded-lg shadow-lg">
                        <div class="flex items-center mb-4">
                            @if($testimonial->image)
                                <img src="{{ asset('storage/' . $testimonial->image) }}" 
                                     alt="{{ $testimonial->name }}" 
                                     class="w-16 h-16 rounded-full object-cover mr-4">
                            @else
                                <div class="w-16 h-16 rounded-full bg-yellow-400/10 flex items-center justify-center mr-4">
                                    <i class="fas fa-user text-2xl text-yellow-400"></i>
                                </div>
                            @endif
                            <div>
                                <h3 class="text-yellow-400 font-semibold">{{ $testimonial->name }}</h3>
                                <p class="text-yellow-400/60 text-sm">
                                    {{ $testimonial->position }}
                                    @if($testimonial->company)
                                        at {{ $testimonial->company }}
                                    @endif
                                </p>
                                <div class="flex text-yellow-400 mt-1">
                                    @for($i = 0; $i < $testimonial->rating; $i++)
                                        <i class="fas fa-star text-sm"></i>
                                    @endfor
                                    @for($i = $testimonial->rating; $i < 5; $i++)
                                        <i class="far fa-star text-sm"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <blockquote class="text-yellow-400/80 italic">
                            "{{ $testimonial->content }}"
                        </blockquote>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        
        <x-contact-section />
        <x-footer />
    </main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script>
    // Hero Slider
    new Swiper('.hero-swiper', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
@endpush
