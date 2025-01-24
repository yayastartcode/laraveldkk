@props(['services'])

<!-- Services Section -->
<section id="services" class="py-16 bg-zinc-900">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-yellow-400 mb-4">Our Services</h2>
            <p class="text-yellow-400/60">Professional auto body repair and customization services</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-black p-6 rounded-lg shadow-lg group hover:bg-yellow-400/5 transition-colors">
                <div class="w-16 h-16 bg-yellow-400/10 rounded-lg flex items-center justify-center mb-6 group-hover:bg-yellow-400/20 transition-colors">
                    <i class="{{ $service->icon ?? 'fas fa-wrench' }} text-3xl text-yellow-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-yellow-400 mb-4">{{ $service->title }}</h3>
                <p class="text-yellow-400/60 mb-6">{{ $service->description }}</p>
                @if($service->features)
                    <ul class="space-y-2 mb-6">
                        @foreach($service->features as $feature)
                            <li class="flex items-center text-yellow-400/80">
                                <i class="fas fa-check text-yellow-400 mr-2"></i>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>
                @endif
                <a href="{{ route('services.show', $service->slug) }}" 
                   class="inline-block text-yellow-400 hover:text-yellow-300 transition-colors">
                    Learn More <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
