<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;align-items:center;gap:12px;">
            <a href="{{ route('admin.history.index') }}" style="color:var(--text-muted);text-decoration:none;">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 style="font-size:22px;font-weight:700;margin:0;">{{ $pet->name }} — Medical History</h2>
                <p class="vethub-breadcrumb">History / {{ $pet->name }}</p>
            </div>
        </div>
    </x-slot>

    <div style="display:grid;grid-template-columns:280px 1fr;gap:24px;">
        <!-- Pet Profile Card -->
        <div>
            <div class="stat-card-vethub" style="position:sticky;top:80px;text-align:center;">
                <div style="width:80px;height:80px;background:var(--primary-light);border-radius:50%;margin:0 auto 12px;display:flex;align-items:center;justify-content:center;font-size:28px;font-weight:700;color:var(--primary);">
                    {{ substr($pet->name, 0, 1) }}
                </div>
                <h3 style="font-size:18px;font-weight:700;margin:0;">{{ $pet->name }}</h3>
                <span class="badge badge-completed" style="margin:4px 0 16px;">{{ ucfirst($pet->type) }}</span>

                <div style="text-align:left;font-size:13px;border-top:1px solid var(--border-light);padding-top:12px;">
                    <div style="margin-bottom:8px;"><strong>Owner:</strong> {{ $pet->owner->name }}</div>
                    <div style="margin-bottom:8px;"><strong>Phone:</strong> {{ $pet->owner->phone }}</div>
                    <div style="margin-bottom:8px;"><strong>Breed:</strong> {{ $pet->breed ?? '-' }}</div>
                    <div style="margin-bottom:8px;"><strong>Gender:</strong> {{ ucfirst($pet->gender) }}</div>
                    <div><strong>Age:</strong> {{ $pet->age ?? '-' }}</div>
                </div>
            </div>
        </div>

        <!-- Timeline -->
        <div>
            <!-- Medical Records -->
            <div style="margin-bottom:32px;">
                <h4 style="font-size:16px;font-weight:700;margin-bottom:16px;display:flex;align-items:center;gap:8px;">
                    <span style="width:4px;height:20px;background:var(--success);border-radius:4px;"></span>
                    Medical Records ({{ $pet->medicalRecords->count() }})
                </h4>
                @forelse($pet->medicalRecords as $record)
                <div class="stat-card-vethub" style="margin-bottom:12px;border-left:3px solid var(--success);">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                        <strong>{{ \Carbon\Carbon::parse($record->date)->format('d M Y') }}</strong>
                        <span class="badge badge-completed" style="font-size:11px;">{{ $record->doctor->name }}</span>
                    </div>
                    <div style="margin-bottom:8px;">
                        <div style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;margin-bottom:2px;">Diagnosis</div>
                        <div style="font-size:14px;">{{ $record->diagnosis }}</div>
                    </div>
                    <div style="margin-bottom:8px;">
                        <div style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;margin-bottom:2px;">Treatment</div>
                        <div style="font-size:13px;color:var(--text-body);white-space:pre-line;">{{ $record->treatment }}</div>
                    </div>
                    @if($record->medicines->count() > 0)
                    <div style="background:var(--warning-light);padding:10px 14px;border-radius:var(--radius);margin-top:8px;border:1px solid #fde68a;">
                        <div style="font-size:11px;font-weight:600;color:#92400e;text-transform:uppercase;margin-bottom:6px;">💊 Prescription</div>
                        @foreach($record->medicines as $med)
                        <div style="display:flex;justify-content:space-between;font-size:13px;padding:2px 0;">
                            <span>{{ $med->name }} <span style="color:var(--text-muted);">(x{{ $med->pivot->quantity }})</span></span>
                            <span style="color:var(--text-muted);">{{ $med->pivot->dosage ?? '-' }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @empty
                <div class="stat-card-vethub" style="text-align:center;padding:32px;color:var(--text-muted);">No medical records found.</div>
                @endforelse
            </div>

            <!-- Appointments -->
            <div>
                <h4 style="font-size:16px;font-weight:700;margin-bottom:16px;display:flex;align-items:center;gap:8px;">
                    <span style="width:4px;height:20px;background:var(--primary);border-radius:4px;"></span>
                    Appointments ({{ $pet->appointments->count() }})
                </h4>
                @forelse($pet->appointments as $appointment)
                <div class="stat-card-vethub" style="margin-bottom:12px;border-left:3px solid var(--primary);">
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <div>
                            <strong>{{ \Carbon\Carbon::parse($appointment->appointment_at)->format('d M Y, H:i') }}</strong>
                            <div style="font-size:12px;color:var(--primary);font-weight:600;text-transform:uppercase;margin-top:2px;">{{ str_replace('_', ' ', $appointment->type) }}</div>
                        </div>
                        <span class="badge {{ $appointment->status === 'done' ? 'badge-paid' : ($appointment->status === 'cancelled' ? 'badge-cancelled' : 'badge-pending') }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="stat-card-vethub" style="text-align:center;padding:32px;color:var(--text-muted);">No appointment history.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
