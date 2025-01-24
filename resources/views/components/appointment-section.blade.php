<section id="appointment" class="bg-black py-20">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-center text-yellow-400 mb-12">Make an Appointment</h2>
        
        <div class="max-w-3xl mx-auto bg-zinc-900 p-8 rounded-lg">
            <form action="{{ route('appointment.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                        <label class="block text-yellow-100 mb-2">Service</label>
                        <select name="service" 
                                required 
                                class="w-full px-4 py-2 rounded bg-black text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            <option value="">Select a service</option>
                            <option value="karoseri">Karoseri</option>
                            <option value="engine">Engine Maintenance</option>
                            <option value="body">Body Repair</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-yellow-100 mb-2">Preferred Date</label>
                        <input type="date" 
                               name="preferred_date" 
                               required 
                               min="{{ date('Y-m-d') }}"
                               class="w-full px-4 py-2 rounded bg-black text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>

                    <div>
                        <label class="block text-yellow-100 mb-2">Preferred Time</label>
                        <select name="preferred_time" 
                                required 
                                class="w-full px-4 py-2 rounded bg-black text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            <option value="">Select a time</option>
                            <option value="09:00">09:00 AM</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="11:00">11:00 AM</option>
                            <option value="13:00">01:00 PM</option>
                            <option value="14:00">02:00 PM</option>
                            <option value="15:00">03:00 PM</option>
                            <option value="16:00">04:00 PM</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label class="block text-yellow-100 mb-2">Message</label>
                    <textarea name="message" 
                              rows="4" 
                              class="w-full px-4 py-2 rounded bg-black text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400"></textarea>
                </div>
                
                <button type="submit" 
                        class="w-full bg-yellow-400 text-black py-3 rounded-lg font-semibold hover:bg-yellow-300 transition-colors">
                    Book Appointment
                </button>
            </form>
        </div>
    </div>
</section>
