<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">Edit Akun</h2>
            <p class="vethub-breadcrumb">Admin / Akun / Edit</p>
        </div>
    </x-slot>
    <div style="max-width:640px;">
        <div class="stat-card-vethub">
            <form action="{{ route('admin.accounts.update', $account) }}" method="POST">
                @csrf
                @method('PUT')
                <div style="display:flex;flex-direction:column;gap:16px;">
                    <div>
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $account->name) }}" required>
                        @error('name') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label>Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $account->email) }}" required>
                        @error('email') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label>Peran (Role)</label>
                        <select name="role" required>
                            <option value="admin" {{ old('role', $account->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="doctor" {{ old('role', $account->role) == 'doctor' ? 'selected' : '' }}>Dokter</option>
                        </select>
                        @error('role') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-top:12px;padding-top:12px;border-top:1px dashed var(--border-color);">
                        <p style="font-size:13px;color:var(--text-muted);margin-bottom:8px;">Biarkan kosong jika tidak ingin mengubah kata sandi.</p>
                        
                        <label>Kata Sandi Baru (Opsional)</label>
                        <input type="password" name="password" placeholder="Kata sandi baru">
                        @error('password') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label>Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi baru">
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:16px;border-top:1px solid var(--border-light);">
                    <a href="{{ route('admin.accounts.index') }}" class="btn-outline">Batal</a>
                    <button type="submit" class="btn-primary">Perbarui Akun</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
