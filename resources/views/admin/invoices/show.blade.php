<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center no-print">
            <div class="flex flex-col">
                <nav class="flex mb-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.invoices.index') }}" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-blue-600 transition-colors">Invoices</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-slate-300 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Transcript Detail</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h2 class="text-2xl font-bold text-slate-800">Invoice Reference</h2>
            </div>
            <div class="flex gap-4">
                <button onclick="window.print()" class="btn-mewah flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2 2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    <span>Print Transcript</span>
                </button>
            </div>
        </div>
    </x-slot>

    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
            .py-12 { padding-top: 0 !important; padding-bottom: 0 !important; }
            .card-enterprise { box-shadow: none !important; background: white !important; border: 1px solid #e2e8f0 !important; }
        }
    </style>

    <div class="py-12">
        <div class="max-w-4xl mx-auto">
            <div class="card-enterprise p-12 md:p-16 relative overflow-hidden">
                <!-- Watermark Logo -->
                <div class="absolute -top-12 -right-12 text-slate-50 opacity-10 select-none pointer-events-none">
                     <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                     </svg>
                </div>

                <div class="flex justify-between items-start mb-16 relative z-10">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-slate-800">Pet Clinic <span class="text-blue-600">Pro</span></h1>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">International Veterinary Standards</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="inline-block px-4 py-2 bg-slate-50 rounded-xl border border-slate-100">
                             <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Invoice Reference</span>
                             <div class="text-lg font-bold text-slate-900 tracking-tight">INV-{{ str_pad($invoice->id, 6, '0', STR_PAD_LEFT) }}</div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-12 mb-16">
                    <div>
                        <h6 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                             <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Bill To
                        </h6>
                        <div class="space-y-1">
                            <div class="text-xl font-bold text-slate-800">{{ $invoice->appointment->pet->owner->name }}</div>
                            <div class="text-sm font-medium text-slate-500">{{ $invoice->appointment->pet->owner->phone }}</div>
                            <div class="text-xs text-slate-400 mt-2 max-w-[240px] leading-relaxed">{{ $invoice->appointment->pet->owner->address }}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <h6 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 flex justify-end items-center gap-2">
                             Settlement Timeline <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                        </h6>
                        <div class="space-y-4">
                            <div>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Issue Date</span>
                                <span class="text-base font-bold text-slate-800">{{ \Carbon\Carbon::parse($invoice->created_at)->format('d M Y') }}</span>
                            </div>
                            <div>
                                <span class="inline-flex px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $invoice->status === 'paid' ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                                    {{ $invoice->status === 'paid' ? 'Paid & Settled' : 'Payment Due' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-16">
                    <h6 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span> Medical Service Particulars
                    </h6>
                    <div class="overflow-hidden border border-slate-100 rounded-2xl">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100">
                                    <th class="py-4 px-8 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Description</th>
                                    <th class="py-4 px-8 text-right text-[10px] font-bold text-slate-400 uppercase tracking-widest">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                <tr>
                                    <td class="py-10 px-8">
                                        <div>
                                            <span class="text-lg font-bold text-slate-800 block">Clinical & Diagnostic Services</span>
                                            <span class="text-[10px] font-medium text-slate-400 uppercase tracking-widest mt-1 block">Patient: {{ $invoice->appointment->pet->name }} ({{ ucfirst($invoice->appointment->pet->type) }})</span>
                                        </div>
                                    </td>
                                    <td class="py-10 px-8 text-right">
                                        <span class="text-xl font-bold text-slate-900">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</span>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="bg-blue-600 text-white">
                                    <td class="py-10 px-8">
                                        <span class="text-xs font-bold uppercase tracking-[0.2em] text-blue-100">Total Net Value</span>
                                    </td>
                                    <td class="py-10 px-8 text-right">
                                        <div class="flex items-baseline justify-end gap-2">
                                            <span class="text-sm font-bold text-blue-100 uppercase tracking-widest italic">IDR</span>
                                            <span class="text-4xl font-bold tracking-tight">{{ number_format($invoice->total_amount, 0, ',', '.') }}</span>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="flex justify-between items-end mt-20 no-print pt-12 border-t border-slate-50">
                    <div class="max-w-[280px]">
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-3">Certification</p>
                        <p class="text-[11px] text-slate-500 leading-relaxed italic">"This document verifies the completion of clinical services as logged in the patient's medical history. Issued under the authority of Pet Clinic Pro."</p>
                    </div>
                    <div class="text-center w-56">
                        <div class="h-16 flex items-center justify-center mb-2 italic text-slate-300 font-serif text-2xl opacity-50 select-none">
                            Administrator
                        </div>
                        <div class="border-t border-slate-900 pt-3">
                            <p class="text-[10px] font-bold text-slate-900 uppercase tracking-widest">Authorized Signature</p>
                        </div>
                    </div>
                </div>

                <div class="mt-16 text-center opacity-10 pointer-events-none">
                     <p class="text-[7px] font-bold uppercase tracking-[0.8em] text-slate-900">SECURE_DOC_REF_{{ strtoupper(substr(md5($invoice->id), 0, 16)) }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
