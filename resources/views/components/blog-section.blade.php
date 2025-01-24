@php
use App\Models\Blog;
$blogs = Blog::orderBy('created_at', 'desc')->take(3)->get();
@endphp

<section id="blog" class="bg-zinc-900 py-20">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-center text-yellow-400 mb-12">Blog Post Terbaru</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($blogs as $blog)
            <article class="bg-black rounded-lg overflow-hidden hover:transform hover:scale-105 transition-transform duration-300">
                @if($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" 
                         alt="{{ $blog->title }}" 
                         class="w-full h-48 object-cover">
                @endif
                     
                <div class="p-6">
                    <div class="flex items-center text-yellow-100 text-sm mb-3">
                        <i class="far fa-calendar-alt mr-2"></i>
                        <span>{{ $blog->created_at->format('d F Y') }}</span>
                    </div>
                    
                    <h3 class="text-xl font-semibold text-yellow-400 mb-3">{{ $blog->title }}</h3>
                    <p class="text-yellow-100 mb-4">{{ Str::limit(strip_tags($blog->content), 150) }}</p>
                    
                    <a href="{{ route('blog.show', $blog->slug) }}" 
                       class="text-yellow-400 hover:text-yellow-300 transition-colors inline-flex items-center">
                        Selengkapnya 
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-3 text-center text-yellow-400/60">
                <p>Belum ada artikel yang dipublikasikan.</p>
            </div>
            @endforelse
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('blog.index') }}" 
               class="bg-yellow-400 text-black px-8 py-3 rounded-lg font-semibold hover:bg-yellow-300 transition-colors inline-block">
                Lihat Semua Artikel
            </a>
        </div>
    </div>
</section>
