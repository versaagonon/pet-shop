<x-app-layout>
    <div class="flex flex-col gap-8">
        <!-- Dashboard Header -->
        <div class="flex items-center justify-between no-print">
            <div class="flex items-center gap-4">
                <div class="p-2 bg-emerald-50 rounded-lg">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div class="flex flex-col">
                    <h3 class="text-lg font-bold text-slate-800 leading-tight">Selamat datang kembali, Dr. {{ Auth::user()->name }}</h3>
                    <p class="text-xs font-medium text-slate-400">Siap memberikan perawatan medis profesional.</p>
                </div>
            </div>
            <div class="flex gap-2">
                 <button class="px-4 py-2 bg-emerald-50 text-emerald-600 rounded-lg font-bold text-sm hover:bg-emerald-100 transition-colors">Jadwal Harian</button>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="card-enterprise stat-card">
                <div class="stat-header">
                    <span class="stat-title">Pasien Hari Ini</span>
                    <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div class="stat-value">{{ $today_appointments }}</div>
                <a href="{{ route('doctor.appointments.index') }}" class="stat-footer no-underline">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                    Lihat Antrean
                </a>
            </div>

            <div class="card-enterprise stat-card">
                <div class="stat-header">
                    <span class="stat-title">Kunjungan (Vet)</span>
                    <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <div class="stat-value">{{ $vet_count }}</div>
                <div class="stat-footer text-blue-500">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                    Terjadwal
                </div>
            </div>

            <div class="card-enterprise stat-card">
                <div class="stat-header">
                    <span class="stat-title">Grooming</span>
                    <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="stat-value">{{ $grooming_count }}</div>
                <div class="stat-footer text-emerald-500">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                    Sesi Aktif
                </div>
            </div>

            <div class="card-enterprise stat-card">
                <div class="stat-header">
                    <span class="stat-title">Tamu Hotel</span>
                    <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </div>
                <div class="stat-value">{{ $hotel_count }}</div>
                <div class="stat-footer text-amber-500">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                    Kamar Terisi
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Quick Actions -->
            <div class="lg:col-span-2 space-y-8">
                <div class="card-enterprise p-8">
                    <h4 class="font-bold text-slate-800 mb-6">Tindakan Segera</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="{{ route('doctor.owners.create') }}" class="dashboard-action-btn">
                            <div class="flex items-center gap-3">
                                <div class="dashboard-icon-sq bg-blue-50 text-blue-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                                </div>
                                <span class="font-bold text-slate-700">Daftar Pemilik</span>
                            </div>
                            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg>
                        </a>

                        <a href="{{ route('doctor.pets.create') }}" class="dashboard-action-btn">
                            <div class="flex items-center gap-3">
                                <div class="dashboard-icon-sq bg-emerald-50 text-emerald-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                </div>
                                <span class="font-bold text-slate-700">Daftar Hewan</span>
                            </div>
                            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg>
                        </a>

                        <a href="{{ route('doctor.appointments.create') }}" class="dashboard-action-btn">
                            <div class="flex items-center gap-3">
                                <div class="dashboard-icon-sq bg-amber-50 text-amber-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <span class="font-bold text-slate-700">Jadwal Kunjungan</span>
                            </div>
                            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg>
                        </a>

                        <a href="{{ route('doctor.medical-records.create') }}" class="dashboard-action-btn">
                            <div class="flex items-center gap-3">
                                <div class="dashboard-icon-sq bg-rose-50 text-rose-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <span class="font-bold text-slate-700">Diagnosis Baru</span>
                            </div>
                            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- News / Insight Section -->
            <div class="lg:col-span-1 space-y-6">
                <div class="card-enterprise p-6 bg-blue-50 border-blue-100">
                    <div class="flex items-center gap-4 mb-4 text-blue-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h4 class="font-bold">Wawasan Klinik</h4>
                    </div>
                    <p class="text-sm text-slate-600 leading-relaxed">Klinik mempertahankan tingkat kepuasan pasien sebesar 98% kuartal ini. Teruskan perawatan medis yang luar biasa!</p>
                </div>

                <div class="card-enterprise p-6">
                    <h4 class="font-bold text-slate-800 mb-4">Tip Pro</h4>
                    <div class="p-4 bg-slate-50 rounded-xl italic text-sm text-slate-600 border-l-4 border-emerald-500">
                        "Selalu periksa riwayat vaksinasi sebelum sesi grooming apa pun."
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
