<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:12px;">
            <div>
                <h2 style="font-size:22px;font-weight:700;margin:0;">Owners</h2>
                <p class="vethub-breadcrumb">Clients / Owners / List Owner</p>
            </div>
            <div style="display:flex;gap:8px;">
                <a href="{{ route('doctor.owners.create') }}" class="btn-primary">+ Add Owner</a>
            </div>
        </div>
    </x-slot>

    <div class="vethub-table-wrapper">
        <div class="table-controls">
            <div class="table-controls-left">
                Show <select><option>10</option><option>25</option><option>50</option></select> entries
            </div>
            <div class="table-controls-right">
                Search: <input type="text" id="searchInput" onkeyup="filterTable()">
            </div>
        </div>

        <table class="vethub-table" id="dataTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($owners as $owner)
                <tr>
                    <td><a href="{{ route('doctor.owners.edit', $owner) }}" class="text-link">{{ $owner->name }}</a></td>
                    <td>{{ $owner->email ?? '-' }}</td>
                    <td>{{ $owner->phone }}</td>
                    <td>{{ $owner->address ?? '-' }}</td>
                    <td>
                        <div style="display:flex;gap:4px;">
                            <a href="{{ route('doctor.owners.edit', $owner) }}" class="action-btn action-btn-edit" title="Edit">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('doctor.owners.destroy', $owner) }}" method="POST" onsubmit="return confirm('Delete this owner?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-btn action-btn-delete" title="Delete">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="table-empty">No data available in table</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
    function filterTable() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        document.querySelectorAll('#dataTable tbody tr').forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(search) ? '' : 'none';
        });
    }
    </script>
</x-app-layout>
