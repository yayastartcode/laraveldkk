<nav class="fixed top-0 left-0 right-0 z-50 bg-black text-yellow-100">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-center h-[var(--header-height)]">
            <!-- Logo -->
            <a href="/" class="text-2xl font-bold text-yellow-400">
                {{ $logoText ?? 'Dalbo Kencana Kreasi' }}
            </a>

            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-8">
                <a href="#about" class="hover:text-yellow-400 transition-colors">About</a>
                <a href="#services" class="hover:text-yellow-400 transition-colors">Services</a>
                <a href="#gallery" class="hover:text-yellow-400 transition-colors">Gallery</a>
                <a href="#contact" class="hover:text-yellow-400 transition-colors">Contact</a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="md:hidden text-yellow-400">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-zinc-900">
        <div class="container mx-auto px-6 py-4 space-y-4">
            <a href="#about" class="block hover:text-yellow-400 transition-colors">About</a>
            <a href="#services" class="block hover:text-yellow-400 transition-colors">Services</a>
            <a href="#gallery" class="block hover:text-yellow-400 transition-colors">Gallery</a>
            <a href="#contact" class="block hover:text-yellow-400 transition-colors">Contact</a>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
@endpush
