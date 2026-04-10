<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.history.index') }}" class="text-slate-400 hover:text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Medical History') }}: {{ $pet->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Pet Profile Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white premium-card p-8 sticky top-8">
                        <div class="text-center mb-8">
                            <div class="w-32 h-32 bg-slate-100 rounded-full mx-auto flex items-center justify-center mb-4 border-4 border-white shadow-xl">
                                <span class="text-4xl font-black text-slate-400 uppercase">{{ substr($pet->name, 0, 1) }}</span>
                            </div>
                            <h3 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">{{ $pet->name }}</h3>
                            <span class="px-4 py-1 bg-slate-900 text-white rounded-full text-[10px] font-black uppercase tracking-widest">
                                {{ $pet->type }}
                            </span>
                        </div>

                        <div class="space-y-6">
                            <div class="border-t border-slate-50 pt-4">
                                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Owner</div>
                                <div class="font-bold text-slate-700 italic">{{ $pet->owner->name }}</div>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Breed & Gender</div>
                                <div class="font-bold text-slate-700 italic">{{ $pet->breed ?? 'Unknown' }} ({{ ucfirst($pet->gender) }})</div>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Age</div>
                                <div class="font-bold text-slate-700 italic">{{ $pet->age ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- History Timeline -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Medical Records Section -->
                    <div>
                        <h4 class="text-lg font-black text-slate-800 uppercase tracking-tighter mb-6 flex items-center gap-3">
                            <span class="w-2 h-8 bg-emerald-500 rounded-full"></span>
                            Medical Records
                        </h4>
                        <div class="space-y-4">
                            @forelse($pet->medicalRecords as $record)
                                <div class="bg-white premium-card p-6 border-l-4 border-l-emerald-500">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="text-sm font-black text-slate-800">{{ \Carbon\Carbon::parse($record->date)->format('d M Y') }}</div>
                                        <div class="text-[10px] font-bold px-2 py-1 bg-emerald-50 text-emerald-700 rounded-md">Dr. {{ $record->doctor->name }}</div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="text-[10px] font-bold text-slate-400 uppercase mb-1">Diagnosis</div>
                                        <div class="text-slate-700 italic">"{{ $record->diagnosis }}"</div>
                                    </div>
                                    <div>
                                        <div class="text-[10px] font-bold text-slate-400 uppercase mb-1">Treatment & Medication</div>
                                        <div class="text-slate-600 text-sm whitespace-pre-line">{{ $record->treatment }}</div>
                                    </div>
                                </div>
                            @empty
                                <div class="bg-slate-50 p-8 rounded-2xl text-center text-slate-400 italic">No medical records found.</div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Appointments Section -->
                    <div>
                        <h4 class="text-lg font-black text-slate-800 uppercase tracking-tighter mb-6 flex items-center gap-3">
                            <span class="w-2 h-8 bg-blue-500 rounded-full"></span>
                            Recent Appointments
                        </h4>
                        <div class="space-y-4">
                            @forelse($pet->appointments as $appointment)
                                <div class="bg-white premium-card p-6 border-l-4 border-l-blue-500">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="text-sm font-black text-slate-800">{{ \Carbon\Carbon::parse($appointment->appointment_at)->format('d M Y, H:i') }}</div>
                                            <div class="text-xs font-bold text-blue-600 uppercase tracking-widest mt-1">{{ str_replace('_', ' ', $appointment->type) }}</div>
                                        </div>
                                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $appointment->status === 'completed' ? 'bg-emerald-100 text-emerald-700' : 'bg-blue-100 text-blue-700' }}">
                                            {{ $appointment->status }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="bg-slate-50 p-8 rounded-2xl text-center text-slate-400 italic">No appointment history.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
