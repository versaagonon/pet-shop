<x-guest-layout>
    <div class="text-center mb-8">
        <h3 class="text-xl font-bold text-slate-800">Lupa Kata Sandi?</h3>
        <p class="text-sm text-slate-500 mt-4 leading-relaxed">
            Silakan hubungi Administrator untuk mereset kata sandi Anda.
        </p>
    </div>
    
    <div class="pt-4 text-center">
        <a href="{{ route('login') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 uppercase tracking-widest transition-colors">
            Kembali ke Halaman Login
        </a>
    </div>
</x-guest-layout>
