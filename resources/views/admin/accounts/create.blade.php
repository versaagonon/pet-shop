<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">Tambah Akun</h2>
            <p class="vethub-breadcrumb">Admin / Akun / Tambah Baru</p>
        </div>
    </x-slot>
    <div style="max-width:640px;">
        <div class="stat-card-vethub">
            <form action="{{ route('admin.accounts.store') }}" method="POST">
                @csrf
                <div style="display:flex;flex-direction:column;gap:16px;">
                    <div>
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                        @error('name') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label>Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" required>
                        @error('email') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label>Peran (Role)</label>
                        <select name="role" required>
                            <option value="" disabled selected>Pilih Peran</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>Dokter</option>
                        </select>
                        @error('role') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label>Kata Sandi (Password)</label>
                        <input type="password" name="password" placeholder="Masukkan kata sandi minimal 8 karakter" required>
                        @error('password') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label>Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi" required>
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:16px;border-top:1px solid var(--border-light);">
                    <a href="{{ route('admin.accounts.index') }}" class="btn-outline">Batal</a>
                    <button type="submit" class="btn-primary">Simpan Akun</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
