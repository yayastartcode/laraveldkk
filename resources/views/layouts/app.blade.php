@php
    use App\Models\Setting;
    $settings = Setting::getSettings();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home') - {{ $settings['site_name'] ?? 'Dalbo Kencana Kreasi' }}</title>
    <link rel="icon" href="{{ asset('storage/' . ($settings['site_favicon'] ?? '')) }}" type="image/x-icon">
    
    <!-- Meta Tags -->
    <meta name="description" content="{{ $settings['site_description'] ?? 'Professional Karoseri Services' }}">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- GLightbox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
    
    <!-- Custom Styles -->
    @stack('styles')
</head>
<body class="bg-zinc-900 min-h-screen">
    <!-- Header -->
    <header class="bg-black text-yellow-400">
        <div class="container mx-auto px-4">
            <!-- Top Bar -->
            <div class="py-2 border-b border-yellow-400/20 text-sm">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        @if(isset($settings['contact_email']))
                            <a href="mailto:{{ $settings['contact_email'] }}" class="hover:text-yellow-300">
                                <i class="fas fa-envelope mr-2"></i>{{ $settings['contact_email'] }}
                            </a>
                        @endif
                        @if(isset($settings['contact_phone']))
                            <a href="tel:{{ $settings['contact_phone'] }}" class="hover:text-yellow-300">
                                <i class="fas fa-phone mr-2"></i>{{ $settings['contact_phone'] }}
                            </a>
                        @endif
                    </div>
                    <div class="flex items-center space-x-4">
                        @if(isset($settings['social_media']))
                            @foreach($settings['social_media'] as $platform => $url)
                                <a href="{{ $url }}" target="_blank" class="hover:text-yellow-300">
                                    <i class="fab fa-{{ $platform }}"></i>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Main Navigation -->
            <nav class="py-4">
                <div class="flex justify-between items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold flex items-center">
                        @if(!empty($settings['site_logo']))
                            <img src="{{ asset('storage/' . $settings['site_logo']) }}" 
                                 alt="{{ $settings['site_name'] ?? 'Dalbo Kencana Kreasi' }}"
                                 class="h-16 w-auto">
                        @else
                            {{ $settings['site_name'] ?? 'Dalbo Kencana Kreasi' }}
                        @endif
                    </a>
                    <div class="flex items-center">
                        <!-- Mobile Menu Button -->
                        <button type="button" 
                                class="md:hidden text-yellow-400 hover:text-yellow-300 focus:outline-none" 
                                id="mobile-menu-button">
                            <i class="fas fa-bars text-2xl"></i>
                        </button>
                        <!-- Desktop Menu -->
                        <div class="hidden md:flex items-center space-x-6">
                            <a href="{{ route('home') }}" class="hover:text-yellow-300">Home</a>
                            <a href="#about" class="hover:text-yellow-300">About Us</a>
                            <a href="#services" class="hover:text-yellow-300">Services</a>
                            <a href="#gallery" class="hover:text-yellow-300">Gallery</a>
                            <a href="#testimonials" class="hover:text-yellow-300">Testimonials</a>
                            <a href="#contact" class="hover:text-yellow-300">Contact</a>
                        </div>
                    </div>
                </div>
                <!-- Mobile Menu -->
                <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
                    <div class="flex flex-col space-y-4">
                        <a href="{{ route('home') }}" class="hover:text-yellow-300">Home</a>
                        <a href="#about" class="hover:text-yellow-300">About Us</a>
                        <a href="#services" class="hover:text-yellow-300">Services</a>
                        <a href="#gallery" class="hover:text-yellow-300">Gallery</a>
                        <a href="#testimonials" class="hover:text-yellow-300">Testimonials</a>
                        <a href="#contact" class="hover:text-yellow-300">Contact</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    @stack('scripts')
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
    @endpush
    
    <!-- GLightbox JS -->
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    
    <!-- Initialize GLightbox -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true,
                autoplayVideos: true
            });
        });
    </script>
</body>
</html>
