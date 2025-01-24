@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-black to-zinc-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <!-- Logo -->
        <div class="flex justify-center mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12">
        </div>
        
        <!-- Login Form -->
        <div class="bg-zinc-800/50 backdrop-blur-sm rounded-lg shadow-xl p-8 border border-yellow-400/20">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-yellow-400">Admin Login</h2>
                <p class="mt-2 text-sm text-yellow-100">Sign in to access dashboard</p>
            </div>

            @if($errors->any())
                <div class="mb-4 bg-red-500/10 border border-red-500/50 rounded-lg p-4">
                    <ul class="list-disc list-inside text-sm text-red-500">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-6" method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-yellow-400 mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-yellow-400/50"></i>
                        </div>
                        <input id="email" 
                               name="email" 
                               type="email" 
                               required 
                               class="appearance-none rounded-lg relative block w-full pl-10 px-3 py-2 border border-yellow-400/20 bg-black/50 placeholder-yellow-400/50 text-yellow-100 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 sm:text-sm"
                               value="{{ old('email') }}"
                               placeholder="Enter your email">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-yellow-400 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-yellow-400/50"></i>
                        </div>
                        <input id="password" 
                               name="password" 
                               type="password" 
                               required 
                               class="appearance-none rounded-lg relative block w-full pl-10 px-3 py-2 border border-yellow-400/20 bg-black/50 placeholder-yellow-400/50 text-yellow-100 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 sm:text-sm"
                               placeholder="Enter your password">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" 
                               name="remember" 
                               type="checkbox" 
                               class="h-4 w-4 text-yellow-400 focus:ring-yellow-400 border-yellow-400/20 rounded bg-black/50">
                        <label for="remember_me" class="ml-2 block text-sm text-yellow-100">Remember me</label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" 
                           class="text-sm text-yellow-400 hover:text-yellow-300">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button type="submit" 
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent rounded-lg text-sm font-medium text-black bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400 transition-all duration-300">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fas fa-sign-in-alt text-black group-hover:transform group-hover:translate-x-1 transition-transform"></i>
                    </span>
                    Sign in
                </button>
            </form>
        </div>

        <!-- Footer -->
        <p class="mt-8 text-center text-sm text-yellow-100">
            &copy; {{ date('Y') }} PT Dalbo Kencana Kreasi. All rights reserved.
        </p>
    </div>
</div>
@endsection
