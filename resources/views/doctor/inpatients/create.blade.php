<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">Daftar Rawat Inap</h2>
            <p class="vethub-breadcrumb">Rawat Inap / Pendaftaran Baru</p>
        </div>
    </x-slot>

    <div style="max-width:800px;">
        <div class="stat-card-vethub">
            <form action="{{ route('doctor.inpatients.store') }}" method="POST">
                @csrf
                <div style="display:flex;flex-direction:column;gap:20px;">
                    <div>
                        <label>Pilih Pasien (Hewan)</label>
                        <select name="pet_id" required>
                            <option value="">-- Pilih Hewan --</option>
                            @foreach($pets as $pet)
                                <option value="{{ $pet->id }}">{{ $pet->name }} ({{ $pet->owner->name }}) - {{ $pet->type }}</option>
                            @endforeach
                        </select>
                        @error('pet_id') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label>Nomor Kamar / Kandang</label>
                        <input type="text" name="room_number" placeholder="cth: Kandang A1, Ruang VIP" value="{{ old('room_number') }}">
                        @error('room_number') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label>Diagnosis Awal</label>
                        <textarea name="diagnosis" rows="3" placeholder="Masukkan diagnosis singkat..." required>{{ old('diagnosis') }}</textarea>
                        @error('diagnosis') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label>Rencana Pengobatan / Instruksi</label>
                        <textarea name="treatment_plan" rows="4" placeholder="Instruksi pemberian obat, makanan, dll..." required>{{ old('treatment_plan') }}</textarea>
                        @error('treatment_plan') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:32px;padding-top:20px;border-top:1px solid var(--border-light);">
                    <a href="{{ route('doctor.inpatients.index') }}" class="btn-outline">Batal</a>
                    <button type="submit" class="btn-primary">Daftarkan Pasien</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
