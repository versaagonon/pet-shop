<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">{{ isset($medicalRecord) ? 'Ubah Rekam Medis' : 'Rekam Medis Baru' }}</h2>
            <p class="vethub-breadcrumb">Rekam Medis / {{ isset($medicalRecord) ? 'Ubah' : 'Tambah Baru' }}</p>
        </div>
    </x-slot>
    <div style="max-width:720px;">
        <div class="stat-card-vethub">
            <form action="{{ isset($medicalRecord) ? route('doctor.medical-records.update', $medicalRecord) : route('doctor.medical-records.store') }}" method="POST">
                @csrf
                @if(isset($medicalRecord)) @method('PUT') @endif
                <div style="display:flex;flex-direction:column;gap:16px;">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label>Hewan</label>
                            <select name="pet_id" required>
                                <option value="">Pilih Hewan</option>
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->id }}" {{ (isset($medicalRecord) && $medicalRecord->pet_id == $pet->id) || old('pet_id', request('pet_id')) == $pet->id || (isset($selectedPet) && $selectedPet && $selectedPet->id == $pet->id) ? 'selected' : '' }}>{{ $pet->name }} — {{ $pet->owner->name }}</option>
                                @endforeach
                            </select>
                            @error('pet_id') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label>Tanggal</label>
                            <input type="date" name="date" value="{{ isset($medicalRecord) ? $medicalRecord->date : old('date', date('Y-m-d')) }}" required>
                        </div>
                    </div>
                    <div>
                        <label>Diagnosis</label>
                        <input type="text" name="diagnosis" value="{{ $medicalRecord->diagnosis ?? old('diagnosis') }}" placeholder="Masukkan diagnosis" required>
                        @error('diagnosis') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label>Pengobatan</label>
                        <textarea name="treatment" rows="3" placeholder="Jelaskan pengobatan yang diberikan" required>{{ $medicalRecord->treatment ?? old('treatment') }}</textarea>
                        @error('treatment') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <!-- Medicine / Prescription Section -->
                    <div style="border-top:1px solid var(--border-light);padding-top:16px;">
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                            <label style="margin:0;font-size:14px;font-weight:700;">💊 Resep / Obat</label>
                            <button type="button" onclick="addMedicineRow()" class="btn-outline" style="padding:4px 12px;font-size:12px;">+ Tambah Obat</button>
                        </div>
                        <div id="medicine-rows">
                            @if(isset($medicalRecord) && $medicalRecord->medicines->count() > 0)
                                @foreach($medicalRecord->medicines as $i => $med)
                                <div class="medicine-row" style="display:grid;grid-template-columns:2fr 1fr 2fr auto;gap:8px;margin-bottom:8px;align-items:end;">
                                    <div>
                                        <label style="font-size:11px;">Obat</label>
                                        <select name="medicines[{{ $i }}][id]" style="font-size:13px;">
                                            <option value="">Pilih</option>
                                            @foreach($medicines as $m)
                                                <option value="{{ $m->id }}" {{ $med->id == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label style="font-size:11px;">Jml</label>
                                        <input type="number" name="medicines[{{ $i }}][quantity]" value="{{ $med->pivot->quantity }}" min="1" style="font-size:13px;">
                                    </div>
                                    <div>
                                        <label style="font-size:11px;">Dosis</label>
                                        <input type="text" name="medicines[{{ $i }}][dosage]" value="{{ $med->pivot->dosage }}" placeholder="cth. 2x sehari" style="font-size:13px;">
                                    </div>
                                    <button type="button" onclick="this.closest('.medicine-row').remove()" class="action-btn action-btn-delete" style="margin-bottom:2px;" title="Hapus">
                                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                                @endforeach
                            @endif
                        </div>
                        <div id="no-medicine-msg" style="text-align:center;padding:12px;color:var(--text-muted);font-size:13px;{{ (isset($medicalRecord) && $medicalRecord->medicines->count() > 0) ? 'display:none;' : '' }}">
                            Belum ada obat yang ditambahkan. Klik "+ Tambah Obat" untuk memberi resep.
                        </div>
                    </div>
                </div>

                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:16px;border-top:1px solid var(--border-light);">
                    <a href="{{ route('doctor.medical-records.index') }}" class="btn-outline">Batal</a>
                    <button type="submit" class="btn-primary">{{ isset($medicalRecord) ? 'Simpan Perubahan' : 'Simpan Rekam Medis' }}</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    let medRowIndex = {{ isset($medicalRecord) ? $medicalRecord->medicines->count() : 0 }};
    const medicineOptions = `<option value="">Pilih</option>@foreach($medicines as $m)<option value="{{ $m->id }}">{{ $m->name }}</option>@endforeach`;

    function addMedicineRow() {
        document.getElementById('no-medicine-msg').style.display = 'none';
        const row = document.createElement('div');
        row.className = 'medicine-row';
        row.style.cssText = 'display:grid;grid-template-columns:2fr 1fr 2fr auto;gap:8px;margin-bottom:8px;align-items:end;';
        row.innerHTML = `
            <div><label style="font-size:11px;">Obat</label><select name="medicines[${medRowIndex}][id]" style="font-size:13px;">${medicineOptions}</select></div>
            <div><label style="font-size:11px;">Jml</label><input type="number" name="medicines[${medRowIndex}][quantity]" value="1" min="1" style="font-size:13px;"></div>
            <div><label style="font-size:11px;">Dosis</label><input type="text" name="medicines[${medRowIndex}][dosage]" placeholder="cth. 2x sehari" style="font-size:13px;"></div>
            <button type="button" onclick="this.closest('.medicine-row').remove()" class="action-btn action-btn-delete" style="margin-bottom:2px;" title="Hapus"><svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        `;
        document.getElementById('medicine-rows').appendChild(row);
        medRowIndex++;
    }
    </script>
</x-app-layout>
