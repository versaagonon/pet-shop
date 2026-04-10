<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col">
            <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('doctor.pets.index') }}" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-blue-600 transition-colors">Pasien</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-slate-300 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ isset($pet) ? 'Ubah Pasien' : 'Inisialisasi Profil' }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h2 class="text-2xl font-bold text-slate-800">{{ isset($pet) ? 'Edit Berkas Pasien' : 'Daftar Pasien Baru' }}</h2>
        </div>
    </x-slot>

    <div class="max-w-4xl">
        <div class="card-enterprise p-8 md:p-12">
            <form action="{{ isset($pet) ? route('doctor.pets.update', $pet) : route('doctor.pets.store') }}" method="POST">
                @csrf
                @if(isset($pet))
                    @method('PUT')
                @endif

                <div class="space-y-8">
                    <!-- Owner Link Section -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-2 border-b border-slate-50">
                            <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center text-blue-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <h4 class="font-bold text-slate-800 uppercase tracking-tight text-sm">Penetapan Penanggung Jawab</h4>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2">Tetapkan Penanggung Jawab (Pemilik)</label>
                            <select name="owner_id" class="premium-input w-full" required>
                                <option value="">Pilih Penanggung Jawab dari Daftar</option>
                                @foreach($owners as $owner)
                                    <option value="{{ $owner->id }}" {{ (isset($pet) && $pet->owner_id == $owner->id) || old('owner_id') == $owner->id ? 'selected' : '' }}>
                                        {{ $owner->name }} (Client ID: {{ $owner->id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('owner_id') <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Patient Details Section -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-2 border-b border-slate-50">
                            <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                            <h4 class="font-bold text-slate-800 uppercase tracking-tight text-sm">Identitas Biologis</h4>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-2">Nama Pasien</label>
                                <input type="text" name="name" value="{{ $pet->name ?? old('name') }}" class="premium-input w-full" placeholder="cth. Snowy" required>
                                @error('name') <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-2">Spesies Biologis</label>
                                <select name="type" class="premium-input w-full" required>
                                    <option value="cat" {{ (isset($pet) && $pet->type == 'cat') ? 'selected' : '' }}>Kucing</option>
                                    <option value="dog" {{ (isset($pet) && $pet->type == 'dog') ? 'selected' : '' }}>Anjing</option>
                                    <option value="bird" {{ (isset($pet) && $pet->type == 'bird') ? 'selected' : '' }}>Burung</option>
                                    <option value="other" {{ (isset($pet) && $pet->type == 'other') ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-2">Ras / Varietas</label>
                                <input type="text" name="breed" value="{{ $pet->breed ?? old('breed') }}" class="premium-input w-full" placeholder="cth. Persia">
                                @error('breed') <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-2">Umur</label>
                                <input type="text" name="age" value="{{ $pet->age ?? old('age') }}" class="premium-input w-full" placeholder="cth. 2 Tahun">
                                @error('age') <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-2">Jenis Kelamin</label>
                                <select name="gender" class="premium-input w-full">
                                    <option value="male" {{ (isset($pet) && $pet->gender == 'male') ? 'selected' : '' }}>Jantan</option>
                                    <option value="female" {{ (isset($pet) && $pet->gender == 'female') ? 'selected' : '' }}>Betina</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-8 border-t border-slate-100">
                        <a href="{{ route('doctor.pets.index') }}" class="text-xs font-bold text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-widest">Batalkan Input</a>
                        <button type="submit" class="btn-mewah">
                            {{ isset($pet) ? 'Simpan Perubahan Berkas' : 'Inisialisasi Profil' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
