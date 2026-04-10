<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div class="text-center mb-6">
            <h3 class="text-xl font-bold text-slate-800">Buat Identitas</h3>
            <p class="text-xs text-slate-500 mt-1">Daftar sebagai staf klinik untuk memulai.</p>
        </div>

        <!-- Name -->
        <div class="space-y-1.5">
            <label for="name" class="block text-xs font-bold text-slate-500 uppercase tracking-widest ml-1">Nama Lengkap Sesuai Identitas</label>
            <div class="relative group">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </span>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" 
                       class="premium-input w-full pl-11 py-2.5" placeholder="cth. Dr. John Doe">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="space-y-1.5">
            <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-widest ml-1">Alamat Email</label>
            <div class="relative group">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                </span>
                <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" 
                       class="premium-input w-full pl-11 py-2.5" placeholder="dokter@klinik.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role Selection -->
        <div class="space-y-1.5">
            <label for="role" class="block text-xs font-bold text-slate-500 uppercase tracking-widest ml-1">Peran Profesional</label>
            <div class="relative group">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors pointer-events-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </span>
                <select id="role" name="role" class="premium-input w-full pl-11 py-2.5 bg-white appearance-none" required>
                    <option value="doctor">Dokter Hewan (VET)</option>
                    <option value="admin">Administrator Klinik</option>
                </select>
                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <!-- Password -->
            <div class="space-y-1.5">
                <label for="password" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest">Kata Sandi</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" 
                       class="premium-input w-full py-2.5 text-sm" placeholder="••••••••">
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm Password -->
            <div class="space-y-1.5">
                <label for="password_confirmation" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest">Konfirmasi</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                       class="premium-input w-full py-2.5 text-sm" placeholder="••••••••">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="btn-mewah w-full py-3.5 flex items-center justify-center gap-2 group shadow-lg shadow-blue-200/50 hover:shadow-blue-300/50">
                <span class="text-sm font-bold uppercase tracking-widest">Buat Akun</span>
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </button>
        </div>

        <div class="text-center pt-2">
            <a class="text-[10px] font-bold text-slate-400 hover:text-blue-600 uppercase tracking-widest transition-colors" href="{{ route('login') }}">
                Sudah punya akun? Masuk
            </a>
        </div>
    </form>
</x-guest-layout>
