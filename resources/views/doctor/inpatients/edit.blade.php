<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">Update Rawat Inap</h2>
            <p class="vethub-breadcrumb">Rawat Inap / Detail & Update Pasien</p>
        </div>
    </x-slot>

    <div style="max-width:800px;">
        <!-- Patient Brief Info -->
        <div class="stat-card-vethub" style="margin-bottom:20px;background:var(--primary-light);border-color:rgba(59,130,246,0.3);">
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <div>
                    <h3 style="margin:0;font-size:18px;font-weight:700;color:var(--primary);">{{ $inpatient->pet->name }}</h3>
                    <p style="margin:4px 0 0;font-size:13px;color:var(--text-body);">
                        {{ $inpatient->pet->type }} ({{ $inpatient->pet->breed }}) • Pemilik: {{ $inpatient->pet->owner->name }}
                    </p>
                </div>
                <div style="text-align:right;">
                    <span class="badge" style="background:var(--primary);color:#fff;">{{ $inpatient->status === 'active' ? 'Sedang Dirawat' : 'Sudah Keluar' }}</span>
                    <p style="margin:4px 0 0;font-size:11px;color:var(--text-muted);">Masuk: {{ $inpatient->admission_date->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="stat-card-vethub">
            <form action="{{ route('doctor.inpatients.update', $inpatient) }}" method="POST">
                @csrf
                @method('PUT')
                <div style="display:flex;flex-direction:column;gap:20px;">
                    <div>
                        <label>Nomor Kamar / Kandang</label>
                        <input type="text" name="room_number" value="{{ $inpatient->room_number }}">
                        @error('room_number') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label>Diagnosis / Kondisi Saat Ini</label>
                        <textarea name="diagnosis" rows="3" required>{{ $inpatient->diagnosis }}</textarea>
                        @error('diagnosis') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label>Rencana Pengobatan / Progres</label>
                        <textarea name="treatment_plan" rows="5" required>{{ $inpatient->treatment_plan }}</textarea>
                        @error('treatment_plan') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    @if($inpatient->status === 'active')
                    <div style="background:#fff7ed;padding:16px;border-radius:8px;border:1px solid #fed7aa;">
                        <label style="color:#c2410c;font-weight:700;">Status Pasien</label>
                        <div style="display:flex;gap:16px;margin-top:8px;">
                            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-weight:500;">
                                <input type="radio" name="status" value="active" checked> Masih Dirawat
                            </label>
                            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-weight:500;color:var(--success);">
                                <input type="radio" name="status" value="discharged"> Selesai / Dipulangkan
                            </label>
                        </div>
                    </div>
                    @else
                    <input type="hidden" name="status" value="discharged">
                    @endif
                </div>

                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:32px;padding-top:20px;border-top:1px solid var(--border-light);">
                    <a href="{{ route('doctor.inpatients.index') }}" class="btn-outline">Kembali</a>
                    <button type="submit" class="btn-primary">Update Data Pasien</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
