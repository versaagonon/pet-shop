<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:12px;">
            <div>
                <h2 style="font-size:22px;font-weight:700;margin:0;">Products</h2>
                <p class="vethub-breadcrumb">Products / List</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="btn-primary">+ Add Product</a>
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
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Bought Price</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $i => $product)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-link">{{ $product->name }} (1 {{ $product->unit }})</a>
                        <div style="font-size:11px;color:var(--text-muted);">{{ $product->description ?? '' }}</div>
                    </td>
                    <td>{{ $product->category }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($product->bought_price, 0, ',', '.') }}</td>
                    <td>{{ number_format($product->stock) }} - (0 {{ $product->unit }})</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:8px;">
                            <form action="{{ route('admin.products.toggle', $product) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" style="display:inline-flex;align-items:center;gap:4px;padding:4px 10px;border-radius:20px;border:none;cursor:pointer;font-size:12px;font-weight:600;{{ $product->is_active ? 'background:#3b82f6;color:#fff;' : 'background:#e5e7eb;color:#6b7280;' }}">
                                    <span style="width:14px;height:14px;border-radius:50%;background:{{ $product->is_active ? '#fff' : '#9ca3af' }};display:inline-block;"></span>
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="table-empty">No data available in table</td></tr>
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
