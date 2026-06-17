<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:12px;">
            <div>
                <h2 style="font-size:22px;font-weight:700;margin:0;">Pengeluaran</h2>
                <p class="vethub-breadcrumb">Admin / Pengeluaran / Daftar</p>
            </div>
            <a href="{{ route('admin.expenses.create') }}" class="btn-primary">+ Tambah Pengeluaran</a>
        </div>
    </x-slot>

    <div class="vethub-table-wrapper">
        <div class="table-controls">
            <div class="table-controls-left">Tampilkan <select><option>10</option><option>25</option><option>50</option></select> entri</div>
            <div class="table-controls-right">Cari: <input type="text" id="searchInput" onkeyup="filterTable()"></div>
        </div>
        
        @if(session('success'))
            <div style="background-color: var(--success-light); color: var(--success); padding: 10px; border-radius: var(--radius); margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        <table class="vethub-table" id="dataTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Jumlah Nominal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($expenses as $i => $expense)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}</td>
                    <td>{{ $expense->description }}</td>
                    <td style="font-weight:600;">Rp {{ number_format($expense->amount, 0, ',', '.') }}</td>
                    <td>
                        <div style="display:flex;gap:4px;">
                            <form action="{{ route('admin.expenses.destroy', $expense) }}" method="POST" onsubmit="return confirm('Hapus pengeluaran ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-btn action-btn-delete" title="Hapus">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="table-empty">Tidak ada data pengeluaran tersedia</td></tr>
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
