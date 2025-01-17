<section id="testimonials" class="bg-zinc-900 py-20">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-center text-yellow-400 mb-12">What Our Clients Say</h2>
        
        <div class="swiper testimonial-swiper">
            <div class="swiper-wrapper">
                @foreach($testimonials as $testimonial)
                <div class="swiper-slide">
                    <div class="bg-black p-8 rounded-lg text-center max-w-2xl mx-auto">
                        <div class="w-20 h-20 mx-auto mb-6">
                            <img src="{{ $testimonial['avatar'] }}" 
                                 alt="{{ $testimonial['name'] }}" 
                                 class="w-full h-full object-cover rounded-full">
                        </div>
                        
                        <blockquote class="text-yellow-100 text-lg mb-6">
                            "{{ $testimonial['quote'] }}"
                        </blockquote>
                        
                        <cite class="block">
                            <span class="text-yellow-400 font-semibold block">{{ $testimonial['name'] }}</span>
                            <span class="text-yellow-100 text-sm">{{ $testimonial['company'] }}</span>
                        </cite>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="swiper-pagination mt-8"></div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    new Swiper('.testimonial-swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
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
