@php
    use App\Models\Setting;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - {{ Setting::getSettings()['site_name'] ?? 'Dalbo Kencana Kreasi' }}</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    @stack('styles')
</head>
<body class="bg-zinc-900 min-h-screen">
    <div class="flex h-screen bg-zinc-900">
        <!-- Sidebar -->
        <div class="w-64 bg-black text-yellow-400 px-4 py-6">
            <div class="mb-8">
                @php
                    $settings = Setting::getSettings();
                @endphp
                @if(!empty($settings['site_logo']))
                    <img src="{{ asset('storage/' . $settings['site_logo']) }}" 
                         alt="{{ $settings['site_name'] ?? 'Dalbo Kencana Kreasi' }}"
                         class="h-16 w-auto">
                @else
                    {{ $settings['site_name'] ?? 'Dalbo Kencana Kreasi' }}
                @endif
                <p class="text-sm text-yellow-400/60">Admin Panel</p>
            </div>

            <nav class="space-y-4">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-2 text-yellow-400 hover:bg-yellow-400/10 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-yellow-400/10' : '' }}">
                    <i class="fas fa-home w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>

                <!-- Sliders -->
                <a href="{{ route('admin.sliders.index') }}" 
                   class="flex items-center px-4 py-2 text-yellow-400 hover:bg-yellow-400/10 rounded-lg {{ request()->routeIs('admin.sliders.*') ? 'bg-yellow-400/10' : '' }}">
                    <i class="fas fa-images w-5"></i>
                    <span class="ml-3">Sliders</span>
                </a>

                <!-- Services -->
                <!-- <a href="{{ route('admin.services.index') }}" 
                   class="flex items-center px-4 py-2 text-yellow-400 hover:bg-yellow-400/10 rounded-lg {{ request()->routeIs('admin.services.*') ? 'bg-yellow-400/10' : '' }}">
                    <i class="fas fa-wrench w-5"></i>
                    <span class="ml-3">Services</span>
                </a> -->
                <!-- Blog -->
                <a href="{{ route('admin.blogs.index') }}" 
                   class="flex items-center px-4 py-2 text-yellow-400 hover:bg-yellow-400/10 rounded-lg {{ request()->routeIs('admin.blogs.*') ? 'bg-yellow-400/10' : '' }}">
                    <i class="fas fa-newspaper w-5"></i>
                    <span class="ml-3">Blog</span>
                </a>

                <!-- Categories -->
                <a href="{{ route('admin.categories.index') }}" 
                   class="flex items-center px-4 py-2 text-yellow-400 hover:bg-yellow-400/10 rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-yellow-400/10' : '' }}">
                    <i class="fas fa-folder w-5"></i>
                    <span class="ml-3">Categories</span>
                </a>

                <!-- Gallery -->
                <a href="{{ route('admin.galleries.index') }}" 
                   class="flex items-center px-4 py-2 text-yellow-400 hover:bg-yellow-400/10 rounded-lg {{ request()->routeIs('admin.galleries.*') ? 'bg-yellow-400/10' : '' }}">
                    <i class="fas fa-images w-5"></i>
                    <span class="ml-3">Gallery</span>
                </a>

                <!-- Testimonials -->
                <a href="{{ route('admin.testimonials.index') }}" 
                   class="flex items-center px-4 py-2 text-yellow-400 hover:bg-yellow-400/10 rounded-lg {{ request()->routeIs('admin.testimonials.*') ? 'bg-yellow-400/10' : '' }}">
                    <i class="fas fa-quote-right w-5"></i>
                    <span class="ml-3">Testimonials</span>
                </a>

                <!-- Settings -->
                <a href="{{ route('admin.settings.index') }}" 
                   class="flex items-center px-4 py-2 text-yellow-400 hover:bg-yellow-400/10 rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-yellow-400/10' : '' }}">
                    <i class="fas fa-cog w-5"></i>
                    <span class="ml-3">Settings</span>
                </a>

            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-black shadow-lg">
                <div class="container mx-auto px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <!-- Mobile menu button if needed -->
                        </div>
                        <div class="flex items-center">
                            <span class="text-yellow-400 mr-4">{{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-yellow-400 hover:text-yellow-300">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-zinc-900">
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-500/10 border border-green-500 text-green-500 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-500/10 border border-red-500 text-red-500 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
