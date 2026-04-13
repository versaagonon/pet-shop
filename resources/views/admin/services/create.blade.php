<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">{{ isset($service) ? 'Ubah Layanan' : 'Tambah Layanan' }}</h2>
            <p class="vethub-breadcrumb">Layanan / {{ isset($service) ? 'Ubah' : 'Tambah Baru' }}</p>
        </div>
    </x-slot>
    <div style="max-width:640px;">
        <div class="stat-card-vethub">
            <form action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" method="POST">
                @csrf
                @if(isset($service)) @method('PUT') @endif
                <div style="display:flex;flex-direction:column;gap:16px;">
                    <div>
                        <label>Nama Layanan</label>
                        <input type="text" name="name" value="{{ $service->name ?? old('name') }}" placeholder="cth. Grooming Kombinasi" required>
                        @error('name') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label>Durasi</label>
                            <select name="duration" required>
                                <option value="15 Menit" {{ (isset($service) && $service->duration == '15 Menit') ? 'selected' : '' }}>15 Menit</option>
                                <option value="30 Menit" {{ (isset($service) && $service->duration == '30 Menit') || !isset($service) ? 'selected' : '' }}>30 Menit</option>
                                <option value="45 Menit" {{ (isset($service) && $service->duration == '45 Menit') ? 'selected' : '' }}>45 Menit</option>
                                <option value="1 Jam" {{ (isset($service) && $service->duration == '1 Jam') ? 'selected' : '' }}>1 Jam</option>
                                <option value="2 Jam" {{ (isset($service) && $service->duration == '2 Jam') ? 'selected' : '' }}>2 Jam</option>
                                <option value="3 Jam" {{ (isset($service) && $service->duration == '3 Jam') ? 'selected' : '' }}>3 Jam</option>
                            </select>
                        </div>
                        <div>
                            <label>Harga (IDR)</label>
                            <input type="number" name="price" value="{{ $service->price ?? old('price') }}" placeholder="0" min="0" required>
                            @error('price') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:16px;border-top:1px solid var(--border-light);">
                    <a href="{{ route('admin.services.index') }}" class="btn-outline">Batal</a>
                    <button type="submit" class="btn-primary">{{ isset($service) ? 'Simpan Perubahan' : 'Tambah Layanan' }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
