<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col">
            <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.invoices.index') }}" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-blue-600 transition-colors">Invoices</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-slate-300 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Generate Transcript</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h2 class="text-2xl font-bold text-slate-800">Generate New Invoice</h2>
        </div>
    </x-slot>

    <div class="max-w-4xl">
        <div class="card-enterprise p-8 md:p-12">
            <form action="{{ route('admin.invoices.store') }}" method="POST">
                @csrf

                <div class="space-y-8">
                    <!-- Billing Information -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-2 border-b border-slate-50">
                            <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center text-blue-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <h4 class="font-bold text-slate-800 uppercase tracking-tight text-sm">Financial Transcript Details</h4>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2">Payer Profile (Owner)</label>
                            <select name="owner_id" class="premium-input w-full" required>
                                <option value="">Select Responsible Client</option>
                                @foreach($owners as $owner)
                                    <option value="{{ $owner->id }}" {{ old('owner_id') == $owner->id ? 'selected' : '' }}>
                                        {{ $owner->name }} (Reg: {{ $owner->id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('owner_id') <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-2">Settlement Value (IDR)</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-xs pointer-events-none">Rp</span>
                                    <input type="number" name="total_amount" value="{{ old('total_amount') }}" class="premium-input w-full pl-10 font-bold text-slate-900" placeholder="0" min="0" required>
                                </div>
                                @error('total_amount') <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-2">Settlement Status</label>
                                <select name="status" class="premium-input w-full" required>
                                    <option value="unpaid">Unpaid / Arrears</option>
                                    <option value="paid">Paid / Settled</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50/50 p-6 rounded-2xl border border-blue-100/50 flex items-start gap-4">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-blue-500 shadow-sm shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h6 class="font-bold text-blue-900 text-sm mb-1 uppercase tracking-tight">System Information</h6>
                            <p class="text-blue-700/70 text-xs leading-relaxed">The invoice reference code will be generated automatically following standard clinic protocols upon submission.</p>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-8 border-t border-slate-100">
                        <a href="{{ route('admin.invoices.index') }}" class="text-xs font-bold text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-widest">Discard Entry</a>
                        <button type="submit" class="btn-mewah">
                            Generate Transcript
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
