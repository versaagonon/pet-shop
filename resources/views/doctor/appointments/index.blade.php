<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:12px;">
            <div>
                <h2 style="font-size:22px;font-weight:700;margin:0;">Appointment</h2>
                <p class="vethub-breadcrumb">Home / Appointment</p>
            </div>
            <div style="display:flex;align-items:center;gap:12px;">
                <div style="display:flex;align-items:center;gap:6px;padding:6px 14px;border:1px solid var(--border-color);border-radius:var(--radius);font-size:13px;color:var(--text-body);">
                    Today: {{ now()->format('d M Y') }}
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>
        </div>
    </x-slot>

    @php
        $tabs = [
            'booking' => ['label' => 'Bookings', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
            'advent' => ['label' => 'Advent', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            'checkup' => ['label' => 'Checkup', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
            'pharmacy' => ['label' => 'Pharmacy', 'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
            'payment' => ['label' => 'Payment', 'icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z'],
            'done' => ['label' => 'Done', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
        ];
    @endphp

    <div style="margin-bottom:24px;">
        <!-- Tabs -->
        <div class="appointment-tabs">
            @foreach($tabs as $key => $tab)
                <a href="{{ route('doctor.appointments.index', ['status' => $key]) }}"
                   class="appointment-tab {{ $status === $key ? 'active' : '' }}">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $tab['icon'] }}"></path></svg>
                    {{ $tab['label'] }}
                    @if(($counts[$key] ?? 0) > 0)
                        <span style="background:{{ $status === $key ? 'rgba(255,255,255,0.3)' : 'var(--primary-light)' }};color:{{ $status === $key ? '#fff' : 'var(--primary)' }};padding:1px 6px;border-radius:10px;font-size:11px;font-weight:700;">{{ $counts[$key] }}</span>
                    @endif
                </a>
            @endforeach
        </div>

        <!-- Table -->
        <table class="vethub-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Appointment Type</th>
                    <th>Staff Name</th>
                    <th>Notes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_at)->format('d M Y, H:i') }}</td>
                    <td>
                        <div><strong>{{ $appointment->pet->name }}</strong></div>
                        <div style="font-size:12px;color:var(--text-muted);">Owner: {{ $appointment->pet->owner->name }}</div>
                    </td>
                    <td>
                        <span class="badge {{ $appointment->type === 'vet' ? 'badge-completed' : ($appointment->type === 'grooming' ? 'badge-pending' : 'badge-cancelled') }}">
                            {{ str_replace('_', ' ', ucfirst($appointment->type)) }}
                        </span>
                    </td>
                    <td>{{ $appointment->doctor ? $appointment->doctor->name : '-' }}</td>
                    <td style="max-width:200px;font-size:12px;color:var(--text-muted);">{{ Str::limit($appointment->notes, 40) ?? '-' }}</td>
                    <td>
                        <div style="display:flex;gap:4px;">
                            {{-- Advance Status Button (only for doctor-controlled statuses) --}}
                            @if($appointment->next_status)
                                <form action="{{ route('doctor.appointments.status', $appointment) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="action-btn action-btn-info" title="Move to {{ ucfirst($appointment->next_status) }}">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('doctor.appointments.edit', $appointment) }}" class="action-btn action-btn-edit" title="Edit">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            @if(in_array($status, ['booking', 'advent']))
                            <form action="{{ route('doctor.appointments.destroy', $appointment) }}" method="POST" onsubmit="return confirm('Cancel this appointment?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-btn action-btn-delete" title="Cancel">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="table-empty">No data available in table</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($status === 'booking')
    <div style="text-align:right;">
        <a href="{{ route('doctor.appointments.create') }}" class="btn-primary">+ New Appointment</a>
    </div>
    @endif
</x-app-layout>
