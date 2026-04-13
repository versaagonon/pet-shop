<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div class="text-center mb-8">
            <h3 class="text-xl font-bold text-slate-800">Selamat Datang Kembali</h3>
            <p class="text-xs text-slate-500 mt-1">Silakan masukkan kredensial Anda untuk mengakses beranda.</p>
        </div>

        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-widest ml-1">Alamat Email</label>
            <div class="relative group">
                <span class="input-icon-wrapper">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                </span>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                       class="premium-input w-full pl-11 py-3" placeholder="nama@klinik.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <div class="flex items-center justify-between px-1">
                <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Kata Sandi</label>
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-bold text-blue-600 hover:text-blue-800 uppercase tracking-tight transition-colors" href="{{ route('password.request') }}">
                        Lupa?
                    </a>
                @endif
            </div>
            <div class="relative group">
                <span class="input-icon-wrapper">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </span>
                <input id="password" type="password" name="password" required autocomplete="current-password" 
                       class="premium-input w-full pl-11 py-3" placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-xs font-bold text-slate-500 uppercase tracking-tight group-hover:text-slate-700 transition-colors">Tetap masuk</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="btn-mewah w-full py-3.5 flex items-center justify-center gap-2 group shadow-lg shadow-blue-200/50 hover:shadow-blue-300/50">
                <span class="text-sm font-bold uppercase tracking-widest">Masuk</span>
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </button>
        </div>
        
        <div class="text-center pt-2">
             <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest leading-relaxed">
                Hanya untuk karyawan resmi. <br>
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 transition-colors">Minta Akses Akun</a>
             </p>
        </div>
    </form>
</x-guest-layout>
