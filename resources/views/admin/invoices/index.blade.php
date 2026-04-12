<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:12px;">
            <div>
                <h2 style="font-size:22px;font-weight:700;margin:0;">Invoices</h2>
                <p class="vethub-breadcrumb">Admin / Invoices / List</p>
            </div>
            <a href="{{ route('admin.invoices.create') }}" class="btn-primary">+ Create Invoice</a>
        </div>
    </x-slot>

    <div class="vethub-table-wrapper">
        <div class="table-controls">
            <div class="table-controls-left">Show <select><option>10</option><option>25</option><option>50</option></select> entries</div>
            <div class="table-controls-right">Search: <input type="text" id="searchInput" onkeyup="filterTable()"></div>
        </div>
        <table class="vethub-table" id="dataTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Invoice Ref</th>
                    <th>Owner</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoices as $i => $invoice)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <a href="{{ route('admin.invoices.show', $invoice) }}" class="text-link">INV-{{ str_pad($invoice->id, 6, '0', STR_PAD_LEFT) }}</a>
                        <div style="font-size:11px;color:var(--text-muted);">{{ \Carbon\Carbon::parse($invoice->created_at)->format('d M Y') }}</div>
                    </td>
                    <td>{{ $invoice->owner->name }}</td>
                    <td style="font-weight:600;">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $invoice->status === 'paid' ? 'badge-paid' : 'badge-unpaid' }}">
                            {{ $invoice->status === 'paid' ? 'Paid' : 'Unpaid' }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex;gap:4px;">
                            <a href="{{ route('admin.invoices.show', $invoice) }}" class="action-btn action-btn-info" title="View">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                            @if($invoice->status === 'unpaid')
                            <form action="{{ route('admin.invoices.update', $invoice) }}" method="POST">
                                @csrf @method('PUT')
                                <button type="submit" class="action-btn action-btn-edit" title="Mark Paid">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </button>
                            </form>
                            @endif
                            <form action="{{ route('admin.invoices.destroy', $invoice) }}" method="POST" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-btn action-btn-delete" title="Delete">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="table-empty">No data available in table</td></tr>
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
