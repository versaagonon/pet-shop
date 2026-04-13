<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">{{ isset($appointment) ? 'Ubah Janji Temu' : 'Janji Temu Baru' }}</h2>
            <p class="vethub-breadcrumb">Janji Temu / {{ isset($appointment) ? 'Ubah' : 'Jadwalkan Baru' }}</p>
        </div>
    </x-slot>
    <div style="max-width:640px;">
        <div class="stat-card-vethub">
            <form action="{{ isset($appointment) ? route('doctor.appointments.update', $appointment) : route('doctor.appointments.store') }}" method="POST">
                @csrf
                @if(isset($appointment)) @method('PUT') @endif
                <div style="display:flex;flex-direction:column;gap:16px;">
                    <div>
                        <label>Hewan (Pemilik)</label>
                        <select name="pet_id" required>
                            <option value="">Pilih Hewan</option>
                            @foreach($pets as $pet)
                                <option value="{{ $pet->id }}" {{ (isset($appointment) && $appointment->pet_id == $pet->id) || old('pet_id') == $pet->id ? 'selected' : '' }}>{{ $pet->name }} — {{ $pet->owner->name }}</option>
                            @endforeach
                        </select>
                        @error('pet_id') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label>Jenis Janji Temu</label>
                            <select name="type" required>
                                <option value="vet" {{ (isset($appointment) && $appointment->type == 'vet') ? 'selected' : '' }}>Klinik Dokter</option>
                                <option value="grooming" {{ (isset($appointment) && $appointment->type == 'grooming') ? 'selected' : '' }}>Grooming</option>
                                <option value="pet_hotel" {{ (isset($appointment) && $appointment->type == 'pet_hotel') ? 'selected' : '' }}>Hotel Hewan</option>
                            </select>
                        </div>
                        <div>
                            <label>Tanggal & Waktu</label>
                            <input type="datetime-local" name="appointment_at" value="{{ isset($appointment) ? \Carbon\Carbon::parse($appointment->appointment_at)->format('Y-m-d\TH:i') : old('appointment_at') }}" required>
                            @error('appointment_at') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div>
                        <label>Catatan (opsional)</label>
                        <textarea name="notes" rows="3" placeholder="Catatan tambahan untuk janji temu ini...">{{ $appointment->notes ?? old('notes') }}</textarea>
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:16px;border-top:1px solid var(--border-light);">
                    <a href="{{ route('doctor.appointments.index') }}" class="btn-outline">Batal</a>
                    <button type="submit" class="btn-primary">{{ isset($appointment) ? 'Simpan Perubahan' : 'Jadwalkan Janji Temu' }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
