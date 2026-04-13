<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>VetHub - Admin Vet Services</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/premium.css') }}">
    </head>
    <body style="font-family: 'Inter', sans-serif;" x-data="{ sidebarOpen: false }">
        <div class="app-container">
            <!-- Sidebar Overlay (Mobile) -->
            <div class="sidebar-overlay" :class="{ 'active': sidebarOpen }" @click="sidebarOpen = false"></div>

            <!-- Sidebar Navigation -->
            @include('layouts.navigation')

            <!-- Main Content Area -->
            <div class="main-content">
                <!-- Top Navbar (VetHub style) -->
                <header class="top-navbar no-print">
                    <div style="display:flex;align-items:center;gap:16px;">
                        <!-- Hamburger Menu -->
                        <button @click="sidebarOpen = !sidebarOpen" style="background:none;border:none;cursor:pointer;color:var(--text-body);padding:4px;">
                            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>
                        <!-- Calendar Button -->
                        <a href="#" class="calendar-btn" style="font-size:13px;">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Kalender
                        </a>
                    </div>

                    <div style="display:flex;align-items:center;gap:16px;">
                        <!-- User Name + Avatar -->
                        <div style="display:flex;align-items:center;gap:10px;">
                            <span style="font-size:14px;font-weight:600;color:var(--text-dark);">{{ Auth::user()->name }}</span>
                            <div style="width:36px;height:36px;border-radius:50%;background:var(--primary-light);border:2px solid var(--border-color);display:flex;align-items:center;justify-content:center;overflow:hidden;">
                                <svg width="20" height="20" fill="var(--primary)" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Toast Notifications -->
                @if(session('success'))
                <div class="toast-container" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition>
                    <div class="toast toast-success">
                        <svg width="18" height="18" fill="var(--success)" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span style="font-size:14px;color:var(--text-dark);">{{ session('success') }}</span>
                    </div>
                </div>
                @endif

                <!-- Page Header -->
                @isset($header)
                <div style="padding:20px 24px 0;">
                    {{ $header }}
                </div>
                @endisset

                <!-- Page Content -->
                <main style="padding:20px 24px;">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
