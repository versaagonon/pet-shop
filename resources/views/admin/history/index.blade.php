<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Overall Patient History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex gap-4">
                <input type="text" id="patientSearch" placeholder="Search pet or owner name..." class="input-premium max-w-md" onkeyup="filterPatients()">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="patientList">
                @foreach($pets as $pet)
                    <div class="premium-card p-6 patient-item" data-name="{{ strtolower($pet->name) }} {{ strtolower($pet->owner->name) }}">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-black text-xl text-slate-800 uppercase tracking-tighter">{{ $pet->name }}</h3>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $pet->type }}</p>
                            </div>
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-bold uppercase tracking-widest border border-emerald-100">
                                {{ $pet->gender }}
                            </span>
                        </div>
                        
                        <div class="border-t border-slate-50 pt-4 mb-6">
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Owner</div>
                            <div class="font-bold text-slate-700">{{ $pet->owner->name }}</div>
                            <div class="text-xs text-slate-500">{{ $pet->owner->phone }}</div>
                        </div>

                        <div class="flex flex-col gap-2 mb-6">
                            <div class="flex justify-between text-xs">
                                <span class="text-slate-400 font-medium">Med Records:</span>
                                <span class="font-bold text-slate-700">{{ $pet->medicalRecords->count() }}</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-slate-400 font-medium">Appointments:</span>
                                <span class="font-bold text-slate-700">{{ $pet->appointments->count() }}</span>
                            </div>
                        </div>

                        <a href="{{ route('admin.history.show', $pet) }}" class="btn-premium w-full justify-center py-2 text-sm bg-slate-800 hover:bg-slate-900 border-none">
                            View Full History
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function filterPatients() {
            let input = document.getElementById('patientSearch').value.toLowerCase();
            let items = document.getElementsByClassName('patient-item');
            
            for (let item of items) {
                let name = item.getAttribute('data-name');
                if (name.includes(input)) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            }
        }
    </script>
</x-app-layout>
