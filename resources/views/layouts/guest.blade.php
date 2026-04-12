<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>VetHub - Login</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/premium.css') }}">
    </head>
    <body style="font-family:'Inter',sans-serif;">
        <div class="auth-wrapper">
            <div class="auth-card">
                <div class="auth-logo">
                    <svg width="24" height="24" fill="#fff" viewBox="0 0 24 24"><path d="M4.5 12.75a.75.75 0 010-1.5h2.25V9a.75.75 0 011.5 0v2.25H10.5a.75.75 0 010 1.5H8.25V15a.75.75 0 01-1.5 0v-2.25H4.5zM14.25 6a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5zM12 15.75a3.75 3.75 0 017.5 0v.75h-7.5v-.75z"/></svg>
                </div>
                <h2 style="text-align:center;font-size:20px;font-weight:700;margin:0 0 4px;">VetHub</h2>
                <p style="text-align:center;font-size:13px;color:var(--text-muted);margin:0 0 24px;">Pet Clinic Management System</p>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
