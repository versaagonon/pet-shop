<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col">
            <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('doctor.medical-records.index') }}" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-blue-600 transition-colors">Catatan</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-slate-300 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ isset($medicalRecord) ? 'Update Kasus' : 'Entri Baru' }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h2 class="text-2xl font-bold text-slate-800">{{ isset($medicalRecord) ? 'Modifikasi Catatan Medis' : 'Buat Entri Klinis' }}</h2>
        </div>
    </x-slot>

    <div class="max-w-4xl">
        <div class="card-enterprise p-8 md:p-12">
            <form action="{{ isset($medicalRecord) ? route('doctor.medical-records.update', $medicalRecord) : route('doctor.medical-records.store') }}" method="POST">
                @csrf
                @if(isset($medicalRecord))
                    @method('PUT')
                @endif

                <div class="space-y-8">
                    <!-- Case Overview -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-2 border-b border-slate-50">
                            <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center text-blue-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h4 class="font-bold text-slate-800 uppercase tracking-tight text-sm">Dasar Kasus</h4>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-2">Pilih Pasien</label>
                                <select name="pet_id" class="premium-input w-full" required>
                                    <option value="">Pilih Pasien Target</option>
                                    @foreach($pets as $pet)
                                        <option value="{{ $pet->id }}" {{ (isset($medicalRecord) && $medicalRecord->pet_id == $pet->id) || (isset($request_pet_id) && $request_pet_id == $pet->id) || old('pet_id') == $pet->id ? 'selected' : '' }}>
                                            {{ $pet->name }} (Pemilik: {{ $pet->owner->name }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('pet_id') <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-2">Tanggal Pemeriksaan</label>
                                <input type="date" name="date" value="{{ $medicalRecord->date ?? date('Y-m-d') }}" class="premium-input w-full" required>
                                @error('date') <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2">Diagnosis Utama (Ringkasan)</label>
                            <input type="text" name="diagnosis" value="{{ $medicalRecord->diagnosis ?? old('diagnosis') }}" class="premium-input w-full" placeholder="Ringkasan temuan (cth. Alergi Kulit, Cek Rutin)" required>
                            @error('diagnosis') <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Detailed Management -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-2 border-b border-slate-50">
                            <div class="w-8 h-8 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.673.337a2 2 0 01-1.786 0l-.673-.337a6 6 0 00-3.86-.517l-2.387.477a2 2 0 00-1.022.547l.34 3.4a1 1 0 00.995.9l16.174-.015a1 1 0 00.995-.9l.34-3.4zM7 7l5 5 5-5M8 3h8"></path></svg>
                            </div>
                            <h4 class="font-bold text-slate-800 uppercase tracking-tight text-sm">Manajemen Medis</h4>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2">Protokol Pengobatan & Obat-obatan</label>
                            <textarea name="treatment" rows="6" class="premium-input w-full" placeholder="Detail protokol medis yang diterapkan, obat yang diresepkan, dan instruksi tindak lanjut..." required>{{ $medicalRecord->treatment ?? old('treatment') }}</textarea>
                            @error('treatment') <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-8 border-t border-slate-100">
                        <a href="{{ route('doctor.medical-records.index') }}" class="text-xs font-bold text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-widest">Batalkan Kasus</a>
                        <button type="submit" class="btn-mewah">
                            {{ isset($medicalRecord) ? 'Sinkronkan Registri' : 'Simpan Catatan' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
