<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">Dasbor</h2>
            <p class="vethub-breadcrumb">Beranda / Dashboard Klinis</p>
        </div>
    </x-slot>

    <!-- Stats Cards -->
    <div class="stat-card-grid" style="margin-bottom:24px;">
        <div class="stat-card-vethub">
            <div class="stat-title">Pasien Hari Ini</div>
            <div class="stat-value">{{ $today_appointments }}</div>
            <a href="{{ route('doctor.appointments.index') }}" style="font-size:12px;color:var(--primary);text-decoration:none;">Lihat Antrean →</a>
        </div>
        <div class="stat-card-vethub">
            <div class="stat-title">Klinik Hewan</div>
            <div class="stat-value">{{ $vet_count }}</div>
            <span style="font-size:12px;color:var(--text-muted);">Terjadwal hari ini</span>
        </div>
        <div class="stat-card-vethub">
            <div class="stat-title">Grooming</div>
            <div class="stat-value">{{ $grooming_count }}</div>
            <span style="font-size:12px;color:var(--text-muted);">Sesi aktif</span>
        </div>
        <div class="stat-card-vethub">
            <div class="stat-title">Hotel Hewan</div>
            <div class="stat-value">{{ $hotel_count }}</div>
            <span style="font-size:12px;color:var(--text-muted);">Terpesan saat ini</span>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="stat-card-vethub" style="margin-bottom:24px;">
        <h4 style="font-size:16px;font-weight:600;margin:0 0 16px;">Aksi Cepat</h4>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;">
            <a href="{{ route('doctor.owners.create') }}" class="btn-outline" style="justify-content:center;">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                + Tambah Pemilik
            </a>
            <a href="{{ route('doctor.pets.create') }}" class="btn-outline" style="justify-content:center;">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                + Tambah Hewan
            </a>
            <a href="{{ route('doctor.appointments.create') }}" class="btn-outline" style="justify-content:center;">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                + Janji Temu Baru
            </a>
            <a href="{{ route('doctor.medical-records.create') }}" class="btn-outline" style="justify-content:center;">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                + Rekam Medis
            </a>
        </div>
    </div>
</x-app-layout>
