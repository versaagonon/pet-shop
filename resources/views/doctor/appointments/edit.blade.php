<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col">
            <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('doctor.appointments.index') }}" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-blue-600 transition-colors">Appointments</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-slate-300 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ isset($appointment) ? 'Reschedule' : 'New Schedule' }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h2 class="text-2xl font-bold text-slate-800">{{ isset($appointment) ? 'Modify Appointment' : 'Schedule New Visit' }}</h2>
        </div>
    </x-slot>

    <div class="max-w-4xl">
        <div class="card-enterprise p-8 md:p-12">
            <form action="{{ isset($appointment) ? route('doctor.appointments.update', $appointment) : route('doctor.appointments.store') }}" method="POST">
                @csrf
                @if(isset($appointment))
                    @method('PUT')
                @endif

                <div class="space-y-8">
                    <!-- Session Details -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-2 border-b border-slate-50">
                            <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center text-blue-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <h4 class="font-bold text-slate-800 uppercase tracking-tight text-sm">Session Logistics</h4>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2">Target Patient</label>
                            <select name="pet_id" class="premium-input w-full" required>
                                <option value="">Select Patient</option>
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->id }}" {{ (isset($appointment) && $appointment->pet_id == $pet->id) || old('pet_id') == $pet->id ? 'selected' : '' }}>
                                        {{ $pet->name }} (Owner: {{ $pet->owner->name }})
                                    </option>
                                @endforeach
                            </select>
                            @error('pet_id') <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-2">Visit Category</label>
                                <select name="type" class="premium-input w-full" required>
                                    <option value="vet_clinic" {{ (isset($appointment) && $appointment->type == 'vet_clinic') ? 'selected' : '' }}>Vet Clinic (Medical)</option>
                                    <option value="grooming" {{ (isset($appointment) && $appointment->type == 'grooming') ? 'selected' : '' }}>Grooming (Pet Care)</option>
                                    <option value="pet_hotel" {{ (isset($appointment) && $appointment->type == 'pet_hotel') ? 'selected' : '' }}>Pet Hotel (Stay)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-400 mb-2 font-medium">Initial Status</label>
                                <select name="status" class="premium-input w-full" required>
                                    <option value="pending" {{ (isset($appointment) && $appointment->status == 'pending') ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ (isset($appointment) && $appointment->status == 'completed') ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ (isset($appointment) && $appointment->status == 'cancelled') ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2">Schedule Date & Time</label>
                            <input type="datetime-local" name="appointment_at" value="{{ isset($appointment) ? \Carbon\Carbon::parse($appointment->appointment_at)->format('Y-m-d\TH:i') : old('appointment_at') }}" class="premium-input w-full" required>
                            @error('appointment_at') <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-8 border-t border-slate-100">
                        <a href="{{ route('doctor.appointments.index') }}" class="text-xs font-bold text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-widest">Discard Schedule</a>
                        <button type="submit" class="btn-mewah">
                            {{ isset($appointment) ? 'Sync Schedule' : 'Confirm Appointment' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
