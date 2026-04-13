<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:12px;">
            <div>
                <h2 style="font-size:22px;font-weight:700;margin:0;">Hewan Peliharaan</h2>
                <p class="vethub-breadcrumb">Pasien / Daftar</p>
            </div>
            <a href="{{ route('doctor.pets.create') }}" class="btn-primary">+ Tambah Hewan</a>
        </div>
    </x-slot>

    <div class="vethub-table-wrapper">
        <div class="table-controls">
            <div class="table-controls-left">Tampilkan <select><option>10</option><option>25</option><option>50</option></select> entri</div>
            <div class="table-controls-right">Cari: <input type="text" id="searchInput" onkeyup="filterTable()"></div>
        </div>
        <table class="vethub-table" id="dataTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Pemilik</th>
                    <th>Umur / Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pets as $i => $pet)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><a href="{{ route('doctor.pets.edit', $pet) }}" class="text-link">{{ $pet->name }}</a></td>
                    <td>{{ $pet->type }}</td>
                    <td>{{ $pet->owner->name }}</td>
                    <td>{{ $pet->age ?? '-' }} / {{ $pet->gender === 'male' ? 'Jantan' : 'Betina' }}</td>
                    <td>
                        <div style="display:flex;gap:4px;">
                            <a href="{{ route('doctor.pets.edit', $pet) }}" class="action-btn action-btn-edit" title="Ubah">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <a href="{{ route('doctor.medical-records.create', ['pet_id' => $pet->id]) }}" class="action-btn action-btn-info" title="Rekam Medis">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="table-empty">Tidak ada data tersedia di tabel</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <script>
    function filterTable() {
        const s = document.getElementById('searchInput').value.toLowerCase();
        document.querySelectorAll('#dataTable tbody tr').forEach(r => { r.style.display = r.textContent.toLowerCase().includes(s) ? '' : 'none'; });
    }
    </script>
</x-app-layout>
