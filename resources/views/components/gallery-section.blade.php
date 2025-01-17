<section id="gallery" class="bg-black py-20">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-center text-yellow-400 mb-12">Our Gallery</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($gallery as $image)
            <div class="relative group cursor-pointer">
                <img src="{{ $image['url'] }}" 
                     alt="{{ $image['title'] }}" 
                     class="w-full h-64 object-cover rounded-lg">
                     
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-75 transition-all duration-300 rounded-lg flex items-center justify-center">
                    <div class="text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <h3 class="text-yellow-400 font-semibold mb-2">{{ $image['title'] }}</h3>
                        <p class="text-yellow-100 text-sm">{{ $image['category'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
@endpush
