<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">{{ isset($medicine) ? 'Edit Mixed Medicine' : 'Add Mixed Medicine' }}</h2>
            <p class="vethub-breadcrumb">Mixed Medicine / {{ isset($medicine) ? 'Edit' : 'Add New' }}</p>
        </div>
    </x-slot>
    <div style="max-width:640px;">
        <div class="stat-card-vethub">
            <form action="{{ isset($medicine) ? route('admin.medicines.update', $medicine) : route('admin.medicines.store') }}" method="POST" onsubmit="return buildCompositionsJson()">
                @csrf
                @if(isset($medicine)) @method('PUT') @endif
                <div style="display:flex;flex-direction:column;gap:16px;">
                    <div>
                        <label>Medicine Name</label>
                        <input type="text" name="name" value="{{ $medicine->name ?? old('name') }}" placeholder="e.g. grooming, antiparasit" required>
                        @error('name') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label>Price (IDR)</label>
                            <input type="number" name="price" value="{{ $medicine->price ?? old('price') }}" placeholder="0" min="0" required>
                        </div>
                        <div>
                            <label>Stock</label>
                            <input type="number" name="stock" value="{{ $medicine->stock ?? old('stock', 0) }}" placeholder="0" min="0" required>
                        </div>
                    </div>
                    <div>
                        <label>Description</label>
                        <textarea name="description" rows="2" placeholder="Optional notes">{{ $medicine->description ?? old('description') }}</textarea>
                    </div>

                    <!-- Compositions Section -->
                    <div style="border-top:1px solid var(--border-light);padding-top:16px;">
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                            <label style="margin:0;font-size:14px;font-weight:700;">🧪 Compositions</label>
                            <button type="button" id="addCompBtn" class="btn-outline" style="padding:4px 12px;font-size:12px;">+ Add Composition</button>
                        </div>
                        <div id="comp-rows">
                            @php
                                $existingComps = [];
                                if (isset($medicine) && $medicine->compositions) {
                                    $existingComps = json_decode($medicine->compositions, true) ?? [];
                                }
                            @endphp
                            @foreach($existingComps as $comp)
                            <div class="comp-row" style="display:grid;grid-template-columns:2fr 1fr auto;gap:8px;margin-bottom:8px;align-items:end;">
                                <div>
                                    <label style="font-size:11px;">Name</label>
                                    <input type="text" class="comp-name" value="{{ $comp['name'] }}" style="font-size:13px;">
                                </div>
                                <div>
                                    <label style="font-size:11px;">Qty</label>
                                    <input type="number" class="comp-qty" value="{{ $comp['qty'] }}" min="1" style="font-size:13px;">
                                </div>
                                <button type="button" onclick="this.closest('.comp-row').remove();toggleMsg()" class="action-btn action-btn-delete" style="margin-bottom:2px;">✕</button>
                            </div>
                            @endforeach
                        </div>
                        <div id="no-comp-msg" style="text-align:center;padding:12px;color:var(--text-muted);font-size:13px;{{ count($existingComps) > 0 ? 'display:none;' : '' }}">
                            No compositions added yet.
                        </div>
                        <input type="hidden" name="compositions" id="compositionsJson" value="{{ $medicine->compositions ?? '' }}">
                    </div>
                </div>

                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:16px;border-top:1px solid var(--border-light);">
                    <a href="{{ route('admin.medicines.index') }}" class="btn-outline">Cancel</a>
                    <button type="submit" class="btn-primary">{{ isset($medicine) ? 'Save Changes' : 'Add Mixed Medicine' }}</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.getElementById('addCompBtn').addEventListener('click', function() {
        document.getElementById('no-comp-msg').style.display = 'none';
        const row = document.createElement('div');
        row.className = 'comp-row';
        row.style.cssText = 'display:grid;grid-template-columns:2fr 1fr auto;gap:8px;margin-bottom:8px;align-items:end;';
        row.innerHTML = '<div><label style="font-size:11px;">Name</label><input type="text" class="comp-name" placeholder="e.g. Injeksi Antiparasit" style="font-size:13px;"></div><div><label style="font-size:11px;">Qty</label><input type="number" class="comp-qty" value="1" min="1" style="font-size:13px;"></div><button type="button" onclick="this.closest(\'.comp-row\').remove();toggleMsg()" class="action-btn action-btn-delete" style="margin-bottom:2px;">✕</button>';
        document.getElementById('comp-rows').appendChild(row);
    });

    function toggleMsg() {
        const rows = document.querySelectorAll('.comp-row');
        document.getElementById('no-comp-msg').style.display = rows.length === 0 ? '' : 'none';
    }

    function buildCompositionsJson() {
        const names = document.querySelectorAll('.comp-name');
        const qtys = document.querySelectorAll('.comp-qty');
        const comps = [];
        names.forEach(function(el, i) {
            if (el.value.trim()) {
                comps.push({ name: el.value.trim(), qty: parseInt(qtys[i].value) || 1 });
            }
        });
        document.getElementById('compositionsJson').value = comps.length > 0 ? JSON.stringify(comps) : '';
        return true; // allow form submit
    }
    </script>
</x-app-layout>
