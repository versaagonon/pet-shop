<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Luxury Pet Clinic') }}</title>

        <!-- Fonts (Premium Typography) -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/premium.css') }}">
    </head>
    <body class="font-sans text-slate-900 antialiased auth-split-bg">
        <div class="min-h-screen flex flex-col sm:justify-center items-center p-4 relative z-10">
            
            <!-- Logo Section with Luxury Floating Animation -->
            <div class="mb-8 animate-fade-in flex flex-col items-center">
                <a href="/">
                    <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center shadow-xl shadow-blue-200/50 mb-4">
                        <svg class="w-9 h-9 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </a>
                <h1 class="text-2xl font-bold tracking-tight text-slate-800">Pet Clinic <span class="text-blue-600">Pro</span></h1>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-1">Enterprise Solution</p>
            </div>

            <div class="auth-card-wrapper">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center animate-fade-in" style="animation-delay: 0.4s">
                <p class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">© 2026 Premium Clinic Infrastructure</p>
                <div class="flex items-center justify-center gap-4 mt-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-200"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-200"></span>
                </div>
            </div>
        </div>
    </body>
</html>
