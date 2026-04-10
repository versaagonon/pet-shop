<x-app-layout>
    <div class="flex flex-col gap-8">
        <!-- Dashboard Header -->
        <div class="flex items-center justify-between no-print">
            <div class="flex items-center gap-4">
                <div class="p-2 bg-blue-50 rounded-lg">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <button class="px-4 py-2 bg-blue-50 text-blue-600 rounded-lg font-bold text-sm hover:bg-blue-100 transition-colors">Calendar</button>
            </div>
            <div class="flex items-center gap-3">
                 <button class="p-2 text-slate-400 hover:text-blue-500 transition-colors relative">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></span>
                 </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="lg:col-span-2">
                <!-- Top Stats Grid (Revenue) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                    <div class="card-enterprise">
                         <div class="stat-header">
                            <span class="stat-title text-slate-500">Total Pendapatan</span>
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="flex items-baseline gap-2">
                             <span class="text-xl font-bold text-slate-400">Rp</span>
                             <span class="text-4xl font-black text-slate-800">{{ number_format($total_revenue, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('admin.invoices.index') }}" class="stat-footer no-underline">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                            Lihat Detail
                        </a>
                    </div>
                    
                    <div class="card-enterprise">
                         <div class="stat-header">
                            <span class="stat-title text-slate-500">Pendapatan Bulan Ini</span>
                            <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <div class="flex items-baseline gap-2">
                             <span class="text-xl font-bold text-slate-400">Rp</span>
                             <span class="text-4xl font-black text-slate-800">{{ number_format($monthly_revenue, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('admin.invoices.index') }}" class="stat-footer no-underline">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Secondary Stats Grid (Owners & Patients) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                    <div class="card-enterprise stat-card">
                        <div class="stat-header">
                            <span class="stat-title">Pemilik Baru (Bulan Ini)</span>
                            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div class="stat-value">{{ $new_owners_count }}</div>
                        <a href="{{ route('doctor.owners.index') }}" class="stat-footer no-underline">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                            Lihat Detail
                        </a>
                    </div>
                    
                    <div class="card-enterprise stat-card">
                        <div class="stat-header">
                            <span class="stat-title">Hewan Baru (Bulan Ini)</span>
                            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <div class="stat-value">{{ $new_pets_count }}</div>
                        <a href="{{ route('doctor.pets.index') }}" class="stat-footer no-underline">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="card-enterprise p-8">
                     <div class="flex items-center justify-between mb-8">
                         <h4 class="font-bold text-slate-800">Ringkasan Pertumbuhan Klien</h4>
                         <div class="flex gap-4 text-xs font-bold">
                             <span class="flex items-center gap-1"><div class="w-2 h-2 rounded-full bg-blue-500"></div> Pemilik Baru</span>
                             <span class="flex items-center gap-1"><div class="w-2 h-2 rounded-full bg-rose-500"></div> Hewan Baru</span>
                         </div>
                     </div>
                     <div class="h-64 bg-slate-50 rounded-xl flex items-end justify-between px-8 py-4 gap-2">
                         @php
                            $max = max(max($owner_growth), max($pet_growth), 1);
                         @endphp
                         @foreach($months as $index => $m)
                            <div class="w-full flex items-end gap-1 h-full">
                                <div class="w-full bg-blue-500 rounded-t-sm" style="height: {{ ($owner_growth[$index] / $max) * 100 }}%" title="Pemilik: {{ $owner_growth[$index] }}"></div>
                                <div class="w-full bg-rose-500 rounded-t-sm" style="height: {{ ($pet_growth[$index] / $max) * 100 }}%" title="Hewan: {{ $pet_growth[$index] }}"></div>
                            </div>
                         @endforeach
                     </div>
                     <div class="flex justify-between mt-4 px-2">
                         @foreach($months as $m)
                            <span class="text-[10px] font-bold text-slate-400 capitalize">{{ $m }}</span>
                         @endforeach
                     </div>
                </div>
            </div>

            <!-- Sidebar Activity Area -->
            <div class="lg:col-span-1">
                <div class="card-enterprise h-full flex flex-col">
                    <h4 class="font-bold text-slate-800 mb-6 px-1">Aktivitas Terakhir</h4>
                    <div class="space-y-6 flex-grow overflow-y-auto">
                        @foreach($recent_activities as $activity)
                        <div class="flex gap-4 group">
                            <div class="shrink-0 w-10 h-10 border-2 border-blue-50 rounded-xl flex items-center justify-center text-blue-500 group-hover:bg-blue-50 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="text-sm font-bold text-slate-800 truncate">{{ $activity->pet->name }}({{ $activity->pet->owner->name }})</span>
                                <span class="text-xs text-slate-500 truncate">{{ $activity->diagnosis }}</span>
                                <span class="text-[10px] font-bold text-slate-400 mt-1">{{ Carbon\Carbon::parse($activity->date)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <a href="{{ route('admin.history.index') }}" class="w-full text-center mt-8 py-3 bg-slate-50 text-slate-500 font-bold text-[10px] uppercase tracking-widest rounded-xl hover:bg-slate-100 border border-transparent hover:border-slate-200 transition-all no-underline">Lihat Semua Aktivitas</a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
