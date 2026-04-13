<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:12px;">
            <div>
                <h2 style="font-size:22px;font-weight:700;margin:0;">Rawat Inap (Opname)</h2>
                <p class="vethub-breadcrumb">Klinis / Rawat Inap / Daftar</p>
            </div>
            <a href="{{ route('doctor.inpatients.create') }}" class="btn-primary">+ Daftar Pasien Baru</a>
        </div>
    </x-slot>

    <div style="margin-bottom:20px;display:flex;gap:8px;">
        <a href="{{ route('doctor.inpatients.index', ['status' => 'active']) }}" 
           class="btn-mewah-tab {{ $status === 'active' ? 'active' : '' }}">
            Aktif
        </a>
        <a href="{{ route('doctor.inpatients.index', ['status' => 'discharged']) }}" 
           class="btn-mewah-tab {{ $status === 'discharged' ? 'active' : '' }}">
            Riwayat
        </a>
    </div>

    <div class="vethub-table-wrapper">
        <div class="table-controls">
            <div class="table-controls-left">Tampilkan <select><option>10</option><option>25</option><option>50</option></select> entri</div>
            <div class="table-controls-right">Cari: <input type="text" id="searchInput" onkeyup="filterTable()"></div>
        </div>
        <table class="vethub-table" id="dataTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pasien / Pemilik</th>
                    <th>Nomor Kamar</th>
                    <th>Diagnosis</th>
                    <th>Tanggal Masuk</th>
                    @if($status === 'discharged')
                        <th>Tanggal Keluar</th>
                    @endif
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inpatients as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <div style="font-weight:700;color:var(--text-dark);">{{ $item->pet->name }}</div>
                        <div style="font-size:11px;color:var(--text-muted);">Pemilik: {{ $item->pet->owner->name }}</div>
                    </td>
                    <td><span class="badge" style="background:var(--primary-light);color:var(--primary);">{{ $item->room_number ?? '-' }}</span></td>
                    <td title="{{ $item->diagnosis }}">{{ Str::limit($item->diagnosis, 40) }}</td>
                    <td>{{ $item->admission_date->format('d/m/Y H:i') }}</td>
                    @if($status === 'discharged')
                        <td>{{ $item->discharge_date ? $item->discharge_date->format('d/m/Y H:i') : '-' }}</td>
                    @endif
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('doctor.inpatients.edit', $item) }}" class="action-btn action-btn-edit" title="Detail/Ubah">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{ $status === 'discharged' ? '7' : '6' }}" class="table-empty">Tidak ada pasien dalam daftar ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
    function filterTable() {
        const s = document.getElementById('searchInput').value.toLowerCase();
        document.querySelectorAll('#dataTable tbody tr').forEach(r => { 
            const text = r.textContent.toLowerCase();
            r.style.display = text.includes(s) ? '' : 'none'; 
        });
    }
    </script>

    <style>
        .btn-mewah-tab {
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
            background: #fff;
            border: 1px solid var(--border-color);
            transition: all 0.2s;
        }
        .btn-mewah-tab.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }
    </style>
</x-app-layout>
