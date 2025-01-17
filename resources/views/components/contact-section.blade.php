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
                <div class="flex items-start space-x-4">
                    <div class="text-yellow-400 text-2xl w-8">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h3 class="text-yellow-400 font-semibold mb-2">Our Location</h3>
                        <p class="text-yellow-100">123 Workshop Street, Industrial Area<br>Jakarta, Indonesia</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-4">
                    <div class="text-yellow-400 text-2xl w-8">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div>
                        <h3 class="text-yellow-400 font-semibold mb-2">Phone Number</h3>
                        <p class="text-yellow-100">+62 123 456 7890</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-4">
                    <div class="text-yellow-400 text-2xl w-8">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h3 class="text-yellow-400 font-semibold mb-2">Email Address</h3>
                        <p class="text-yellow-100">info@dalbokencanakreasi.com</p>
                    </div>
                </div>
                
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
            </div>
        </div>
    </div>
</section>
