<aside class="sidebar no-print" :class="{ 'open': sidebarOpen }">
    <!-- Sidebar Header -->
    <div class="sidebar-header" style="display:flex;justify-content:space-between;align-items:center;">
        <div style="display:flex;align-items:center;gap:10px;">
            <div class="sidebar-logo">
                <svg width="18" height="18" fill="#fff" viewBox="0 0 24 24"><path d="M4.5 12.75a.75.75 0 010-1.5h2.25V9a.75.75 0 011.5 0v2.25H10.5a.75.75 0 010 1.5H8.25V15a.75.75 0 01-1.5 0v-2.25H4.5zM14.25 6a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5zM12 15.75a3.75 3.75 0 017.5 0v.75h-7.5v-.75z"/></svg>
            </div>
            <div>
                <div style="font-size:15px;font-weight:700;color:var(--text-dark);">VetHub</div>
                <div style="font-size:10px;font-weight:600;color:var(--primary);text-transform:uppercase;letter-spacing:0.05em;">Pet Clinic</div>
            </div>
        </div>
        <button @click="sidebarOpen = false" style="background:none;border:none;cursor:pointer;color:var(--text-muted);padding:4px;">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <!-- Navigation Links -->
    <div style="flex:1;overflow-y:auto;padding:8px 0;">
        <div class="nav-section">
            <p class="nav-label">Menu Utama</p>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') || request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Home
            </a>
        </div>

        @if(Auth::user()->role === 'admin')
        <div class="nav-section" style="margin-top:8px;">
            <p class="nav-label">Administration</p>
            <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Services
            </a>
            <a href="{{ route('admin.invoices.index') }}" class="nav-link {{ request()->routeIs('admin.invoices.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Invoices
            </a>
            <a href="{{ route('admin.history.index') }}" class="nav-link {{ request()->routeIs('admin.history.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                History
            </a>
            <a href="{{ route('admin.medicines.index') }}" class="nav-link {{ request()->routeIs('admin.medicines.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                Mixed Medicine
            </a>
            <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Products
            </a>
        </div>
        @elseif(Auth::user()->role === 'doctor')
        <div class="nav-section" style="margin-top:8px;">
            <p class="nav-label">Clinical</p>
            <a href="{{ route('doctor.owners.index') }}" class="nav-link {{ request()->routeIs('doctor.owners.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Owners
            </a>
            <a href="{{ route('doctor.pets.index') }}" class="nav-link {{ request()->routeIs('doctor.pets.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                Pets
            </a>
            <a href="{{ route('doctor.appointments.index') }}" class="nav-link {{ request()->routeIs('doctor.appointments.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Appointment
            </a>
            <a href="{{ route('doctor.medical-records.index') }}" class="nav-link {{ request()->routeIs('doctor.medical-records.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Medical Records
            </a>
        </div>
        @endif
    </div>

    <!-- Sidebar Footer -->
    <div style="padding:12px 16px;border-top:1px solid var(--border-color);">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="display:flex;align-items:center;gap:8px;width:100%;padding:8px 12px;border-radius:var(--radius);border:none;background:transparent;cursor:pointer;color:var(--text-muted);font-size:13px;font-weight:500;transition:all 0.15s;" onmouseover="this.style.background='var(--danger-light)';this.style.color='var(--danger)'" onmouseout="this.style.background='transparent';this.style.color='var(--text-muted)'">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout
            </button>
        </form>
    </div>
</aside>
