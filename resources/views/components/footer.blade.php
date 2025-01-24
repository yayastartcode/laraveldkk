@php
$settings = App\Models\Setting::getSettings();
@endphp

<footer class="bg-zinc-900 text-yellow-100">
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <!-- Company Info -->
            <div>
            <a href="{{ route('home') }}" class="text-2xl font-bold flex items-center">
                        @if(!empty($settings['site_logo']))
                            <img src="{{ asset('storage/' . $settings['site_logo']) }}" 
                                 alt="{{ $settings['site_name'] ?? 'Dalbo Kencana Kreasi' }}"
                                 class="h-16 w-auto">
                        @else
                            {{ $settings['site_name'] ?? 'Dalbo Kencana Kreasi' }}
                        @endif
                    </a>
                <p class="mb-6">
                PT Dalbo Kencana Kreasi, Berdiri tahun 2022, dan bergerak di bidang otomotif, dengan di dukung oleh sumber daya manusia yang berpengalaman di bidang otomotif.
                </p>
                <div class="flex space-x-4">
                    @if(isset($settings['social_media']['facebook']))
                    <a href="{{ $settings['social_media']['facebook'] }}" target="_blank" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    @endif
                    @if(isset($settings['social_media']['instagram']))
                    <a href="{{ $settings['social_media']['instagram'] }}" target="_blank" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif
                    @if(isset($settings['social_media']['youtube']))
                    <a href="{{ $settings['social_media']['youtube'] }}" target="_blank" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                        <i class="fab fa-youtube"></i>
                    </a>
                    @endif
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-xl font-semibold text-yellow-400 mb-6">Quick Links</h3>
                <ul class="space-y-4">
                    <li>
                        <a href="#about" class="hover:text-yellow-400 transition-colors">About Us</a>
                    </li>
                    <li>
                        <a href="#services" class="hover:text-yellow-400 transition-colors">Our Services</a>
                    </li>
                    <li>
                        <a href="#gallery" class="hover:text-yellow-400 transition-colors">Gallery</a>
                    </li>
                    <li>
                        <a href="#blog" class="hover:text-yellow-400 transition-colors">Blog</a>
                    </li>
                    <li>
                        <a href="#contact" class="hover:text-yellow-400 transition-colors">Contact</a>
                    </li>
                </ul>
            </div>
            
            <!-- Contact Info -->
            <div>
                <h3 class="text-xl font-semibold text-yellow-400 mb-6">Contact Us</h3>
                <ul class="space-y-4">
                    @if(isset($settings['contact_phone']))
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-phone text-yellow-400"></i>
                        <span>{{ $settings['contact_phone'] }}</span>
                    </li>
                    @endif
                    @if(isset($settings['contact_email']))
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-envelope text-yellow-400"></i>
                        <a href="mailto:{{ $settings['contact_email'] }}" class="hover:text-yellow-400 transition-colors">
                            {{ $settings['contact_email'] }}
                        </a>
                    </li>
                    @endif
                    @if(isset($settings['address']))
                    <li class="flex space-x-3">
                        <i class="fas fa-map-marker-alt text-yellow-400 mt-1"></i>
                        <span>{{ $settings['address'] }}</span>
                    </li>
                    @endif
                </ul>
            </div>
            
            <!-- Newsletter -->
            <!-- <div>
                <h3 class="text-xl font-semibold text-yellow-400 mb-6">Newsletter</h3>
                <p class="mb-4">Subscribe to our newsletter for updates and special offers.</p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="email" 
                           name="email" 
                           required 
                           placeholder="Your email address"
                           class="w-full px-4 py-2 rounded bg-black text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <button type="submit" 
                            class="w-full bg-yellow-400 text-black py-2 rounded font-semibold hover:bg-yellow-300 transition-colors">
                        Subscribe
                    </button>
                </form> -->
            </div>
        </div>
        
        <!-- Copyright -->
        <div class="border-t border-yellow-400/20 mt-12 pt-8 text-center">
            <p>&copy; {{ date('Y') }} Dalbo Kencana Kreasi. All rights reserved.</p>
        </div>
    </div>
</footer>
