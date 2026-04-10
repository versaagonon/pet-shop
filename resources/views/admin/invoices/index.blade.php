<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                 <nav class="flex mb-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-blue-600 transition-colors">Admin</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-slate-300 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Tagihan</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h2 class="text-2xl font-bold text-slate-800">Penagihan & Faktur</h2>
            </div>
            <a href="{{ route('admin.invoices.create') }}" class="btn-mewah">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Buat Tagihan
            </a>
        </div>
    </x-slot>

    <div class="flex flex-col gap-6">
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-xl font-bold text-sm flex items-center gap-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="enterprise-table-container">
            <table class="table-enterprise">
                <thead>
                    <tr>
                        <th>Ref Faktur</th>
                        <th>Pemilik</th>
                        <th>Total Jumlah</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoices as $invoice)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td>
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-700 leading-tight">INV-{{ str_pad($invoice->id, 6, '0', STR_PAD_LEFT) }}</span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ \Carbon\Carbon::parse($invoice->created_at)->format('d M Y') }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="font-bold text-slate-700 italic">{{ $invoice->owner->name }}</span>
                            </td>
                            <td>
                                <span class="font-bold text-slate-900">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                @php
                                    $statusClasses = [
                                        'paid' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                        'unpaid' => 'bg-rose-50 text-rose-600 border-rose-100',
                                    ];
                                    $statusLabels = [
                                        'paid' => 'DIBAYAR',
                                        'unpaid' => 'BELUM DIBAYAR',
                                    ];
                                @endphp
                                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-full border w-fit {{ $statusClasses[$invoice->status] ?? 'bg-slate-50 text-slate-500 border-slate-100' }}">
                                    <div class="w-1.5 h-1.5 rounded-full bg-current"></div>
                                    <span class="text-[10px] font-bold uppercase tracking-widest">{{ $statusLabels[$invoice->status] ?? $invoice->status }}</span>
                                </div>
                            </td>
                            <td class="text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.invoices.show', $invoice) }}" class="p-2 text-slate-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-all" title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    
                                    @if($invoice->status === 'unpaid')
                                        <form action="{{ route('admin.invoices.update', $invoice) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-emerald-500 hover:bg-emerald-50 rounded-lg transition-all" title="Tandai Sudah Dibayar">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <form action="{{ route('admin.invoices.destroy', $invoice) }}" method="POST" onsubmit="return confirm('Hapus tagihan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-16 text-center text-slate-300">
                                <p class="font-bold text-sm uppercase tracking-widest">Tagihan Tidak Ditemukan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
