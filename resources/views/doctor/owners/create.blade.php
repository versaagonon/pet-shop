<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col">
            <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('doctor.owners.index') }}" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-blue-600 transition-colors">Pemilik</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-slate-300 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ isset($owner) ? 'Edit Registri' : 'Registrasi Baru' }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h2 class="text-2xl font-bold text-slate-800">{{ isset($owner) ? 'Edit Profil Pemilik' : 'Daftar Pemilik Baru' }}</h2>
        </div>
    </x-slot>

    <div class="max-w-4xl">
        <div class="card-enterprise p-8 md:p-12">
            <form action="{{ isset($owner) ? route('doctor.owners.update', $owner) : route('doctor.owners.store') }}" method="POST">
                @csrf
                @if(isset($owner))
                    @method('PUT')
                @endif

                <div class="space-y-8">
                    <!-- Basic Information Section -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-2 border-b border-slate-50">
                            <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center text-blue-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <h4 class="font-bold text-slate-800 uppercase tracking-tight text-sm">Identitas Pemilik</h4>
                        </div>

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-2">Nama Lengkap Sesuai Identitas</label>
                                <input type="text" name="name" value="{{ $owner->name ?? old('name') }}" class="premium-input w-full" placeholder="cth. Samuel Aditama" required>
                                @error('name') <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-2">Kontak Aman (WhatsApp/Telepon)</label>
                                <input type="text" name="phone" value="{{ $owner->phone ?? old('phone') }}" class="premium-input w-full" placeholder="+62..." required>
                                @error('phone') <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-2">Alamat Email (Opsional)</label>
                                <input type="email" name="email" value="{{ $owner->email ?? old('email') }}" class="premium-input w-full" placeholder="pemilik@domain.com">
                                @error('email') <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Location Section -->
                    <div class="space-y-6">
                         <div class="flex items-center gap-3 pb-2 border-b border-slate-50">
                            <div class="w-8 h-8 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <h4 class="font-bold text-slate-800 uppercase tracking-tight text-sm">Detail Lokasi</h4>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2">Alamat Fisik Lengkap</label>
                            <textarea name="address" rows="3" class="premium-input w-full" placeholder="Detail lokasi fisik...">{{ $owner->address ?? old('address') }}</textarea>
                            @error('address') <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-8 border-t border-slate-100">
                        <a href="{{ route('doctor.owners.index') }}" class="text-xs font-bold text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-widest">Batalkan Perubahan</a>
                        <div class="flex gap-4">
                            <button type="submit" class="btn-mewah">
                                {{ isset($owner) ? 'Terapkan Modifikasi' : 'Selesaikan Registrasi' }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
