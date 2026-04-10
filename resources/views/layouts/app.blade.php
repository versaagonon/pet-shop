<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Pet Clinic') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/premium.css') }}">
    </head>
    <body class="font-sans antialiased text-slate-800" x-data="{ sidebarOpen: false }">
        <div class="app-container" :class="{ 'sidebar-open': sidebarOpen }">
            <!-- Sidebar Navigation Overlay (Mobile) -->
            <div class="sidebar-overlay" :class="{ 'active': sidebarOpen }" @click="sidebarOpen = false"></div>

            <!-- Sidebar Navigation -->
            @include('layouts.navigation')

            <!-- Main Content Area -->
            <div class="main-content">
                <!-- Top Navbar -->
                <header class="top-navbar no-print">
                    <div class="flex items-center gap-4">
                        <button @click="sidebarOpen = true" class="text-slate-500 hover:text-blue-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>
                    </div>

                    <div class="flex items-center gap-4">
                         <!-- User Info -->
                        <div class="hidden sm:flex flex-col text-right mr-2">
                            <span class="text-xs font-bold text-slate-800 leading-tight">{{ Auth::user()->name }}</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ Auth::user()->role }}</span>
                        </div>
                        
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-colors focus:outline-none">
                                    <svg class="w-6 h-6 border-2 border-transparent rounded-full" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">Pengaturan Profil</x-dropdown-link>
                                <x-dropdown-link :href="route('logout')">
                                    Keluar
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </header>

                <!-- Breadcrumb/Header Title -->
                @isset($header)
                <div class="px-8 pt-8">
                     <h2 class="text-xl font-bold text-slate-800">{{ $header }}</h2>
                </div>
                @endisset

                <!-- Page Content -->
                <main class="p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
