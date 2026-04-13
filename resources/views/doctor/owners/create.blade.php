<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">{{ isset($owner) ? 'Ubah Pemilik' : 'Tambah Pemilik' }}</h2>
            <p class="vethub-breadcrumb">Klien / Pemilik / {{ isset($owner) ? 'Ubah' : 'Tambah Baru' }}</p>
        </div>
    </x-slot>

    <div style="max-width:640px;">
        <div class="stat-card-vethub">
            <form action="{{ isset($owner) ? route('doctor.owners.update', $owner) : route('doctor.owners.store') }}" method="POST">
                @csrf
                @if(isset($owner)) @method('PUT') @endif

                <div style="display:flex;flex-direction:column;gap:16px;">
                    <div>
                        <label>Nama</label>
                        <input type="text" name="name" value="{{ $owner->name ?? old('name') }}" placeholder="Nama lengkap" required>
                        @error('name') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label>Nomor Telepon</label>
                            <input type="text" name="phone" value="{{ $owner->phone ?? old('phone') }}" placeholder="08xxxxxxxxxx" required>
                            @error('phone') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="email" name="email" value="{{ $owner->email ?? old('email') }}" placeholder="email@contoh.com">
                            @error('email') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div>
                        <label>Alamat</label>
                        <textarea name="address" rows="3" placeholder="Alamat lengkap">{{ $owner->address ?? old('address') }}</textarea>
                        @error('address') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:16px;border-top:1px solid var(--border-light);">
                    <a href="{{ route('doctor.owners.index') }}" class="btn-outline">Batal</a>
                    <button type="submit" class="btn-primary">{{ isset($owner) ? 'Simpan Perubahan' : 'Tambah Pemilik' }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
Syncing...
