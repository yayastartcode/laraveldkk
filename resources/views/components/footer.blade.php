<footer class="bg-zinc-900 text-yellow-100">
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <!-- Company Info -->
            <div>
                <h3 class="text-2xl font-bold text-yellow-400 mb-6">Dalbo Kencana Kreasi</h3>
                <p class="mb-6">
                    Your trusted partner for all automotive needs. Specializing in karoseri, engine maintenance, and professional body repair services.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
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
            
            <!-- Services -->
            <div>
                <h3 class="text-xl font-semibold text-yellow-400 mb-6">Our Services</h3>
                <ul class="space-y-4">
                    <li>
                        <a href="#" class="hover:text-yellow-400 transition-colors">Karoseri</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-yellow-400 transition-colors">Engine Maintenance</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-yellow-400 transition-colors">Body Repair</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-yellow-400 transition-colors">Paint Services</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-yellow-400 transition-colors">Custom Modifications</a>
                    </li>
                </ul>
            </div>
            
            <!-- Newsletter -->
            <div>
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
                </form>
            </div>
        </div>
        
        <!-- Copyright -->
        <div class="border-t border-yellow-400/20 mt-12 pt-8 text-center">
            <p>&copy; {{ date('Y') }} Dalbo Kencana Kreasi. All rights reserved.</p>
        </div>
    </div>
</footer>
