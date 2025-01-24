@php
$settings = App\Models\Setting::getSettings();
@endphp

<section id="contact" class="bg-black py-20">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-center text-yellow-400 mb-12">Contact Us</h2>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-zinc-900 p-8 rounded-lg">
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-yellow-100 mb-2">Name</label>
                        <input type="text" 
                               name="name" 
                               required 
                               class="w-full px-4 py-2 rounded bg-black text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    
                    <div>
                        <label class="block text-yellow-100 mb-2">Email</label>
                        <input type="email" 
                               name="email" 
                               required 
                               class="w-full px-4 py-2 rounded bg-black text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    
                    <div>
                        <label class="block text-yellow-100 mb-2">Phone</label>
                        <input type="tel" 
                               name="phone" 
                               required 
                               class="w-full px-4 py-2 rounded bg-black text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    
                    <div>
                        <label class="block text-yellow-100 mb-2">Subject</label>
                        <input type="text" 
                               name="subject" 
                               required 
                               class="w-full px-4 py-2 rounded bg-black text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    
                    <div>
                        <label class="block text-yellow-100 mb-2">Message</label>
                        <textarea name="message" 
                                  rows="4" 
                                  required 
                                  class="w-full px-4 py-2 rounded bg-black text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400"></textarea>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-yellow-400 text-black py-3 rounded-lg font-semibold hover:bg-yellow-300 transition-colors">
                        Send Message
                    </button>
                </form>
            </div>
            
            <!-- Contact Information -->
            <div class="space-y-8">
                @if(isset($settings['address']))
                <div class="flex items-start space-x-4">
                    <div class="text-yellow-400 text-2xl w-8">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h3 class="text-yellow-400 font-semibold mb-2">Our Location</h3>
                        <p class="text-yellow-100">{{ $settings['address'] }}</p>
                    </div>
                </div>
                @endif
                
                @if(isset($settings['contact_phone']))
                <div class="flex items-start space-x-4">
                    <div class="text-yellow-400 text-2xl w-8">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div>
                        <h3 class="text-yellow-400 font-semibold mb-2">Phone Number</h3>
                        <p class="text-yellow-100">{{ $settings['contact_phone'] }}</p>
                    </div>
                </div>
                @endif
                
                @if(isset($settings['contact_email']))
                <div class="flex items-start space-x-4">
                    <div class="text-yellow-400 text-2xl w-8">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h3 class="text-yellow-400 font-semibold mb-2">Email Address</h3>
                        <p class="text-yellow-100">{{ $settings['contact_email'] }}</p>
                    </div>
                </div>
                @endif
                
                <div class="flex items-start space-x-4">
                    <div class="text-yellow-400 text-2xl w-8">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <h3 class="text-yellow-400 font-semibold mb-2">Working Hours</h3>
                        <p class="text-yellow-100">
                            Monday - Friday: 8:00 AM - 6:00 PM<br>
                            Saturday: 9:00 AM - 4:00 PM<br>
                            Sunday: Closed
                        </p>
                    </div>
                </div>

                @if(!empty($settings['social_media']))
                <div class="flex items-start space-x-4">
                    <div class="text-yellow-400 text-2xl w-8">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <div>
                        <h3 class="text-yellow-400 font-semibold mb-2">Follow Us</h3>
                        <div class="flex space-x-4">
                            @if(isset($settings['social_media']['facebook']))
                            <a href="{{ $settings['social_media']['facebook'] }}" target="_blank" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                                <i class="fab fa-facebook-f fa-lg"></i>
                            </a>
                            @endif
                            @if(isset($settings['social_media']['instagram']))
                            <a href="{{ $settings['social_media']['instagram'] }}" target="_blank" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                                <i class="fab fa-instagram fa-lg"></i>
                            </a>
                            @endif
                            @if(isset($settings['social_media']['youtube']))
                            <a href="{{ $settings['social_media']['youtube'] }}" target="_blank" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                                <i class="fab fa-youtube fa-lg"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
