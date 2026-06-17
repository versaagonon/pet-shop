<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">Tambah Pengeluaran</h2>
            <p class="vethub-breadcrumb">Admin / Pengeluaran / Tambah Baru</p>
        </div>
    </x-slot>
    <div style="max-width:640px;">
        <div class="stat-card-vethub">
            <form action="{{ route('admin.expenses.store') }}" method="POST">
                @csrf
                <div style="display:flex;flex-direction:column;gap:16px;">
                    <div>
                        <label>Tanggal Pengeluaran</label>
                        <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                        @error('date') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label>Keterangan</label>
                        <textarea name="description" rows="3" placeholder="Contoh: Beli pakan hewan, bayar listrik klinik, dll." required>{{ old('description') }}</textarea>
                        @error('description') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label>Jumlah Nominal (Rp)</label>
                        <input type="number" name="amount" value="{{ old('amount') }}" placeholder="0" min="0" required>
                        @error('amount') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:16px;border-top:1px solid var(--border-light);">
                    <a href="{{ route('admin.expenses.index') }}" class="btn-outline">Batal</a>
                    <button type="submit" class="btn-primary">Simpan Pengeluaran</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
