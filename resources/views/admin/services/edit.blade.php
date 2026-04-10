<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col">
            <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.services.index') }}" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-blue-600 transition-colors">Services</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-slate-300 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ isset($service) ? 'Edit Asset' : 'New Asset' }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h2 class="text-2xl font-bold text-slate-800">{{ isset($service) ? 'Edit Clinic Service' : 'Deploy New Service' }}</h2>
        </div>
    </x-slot>

    <div class="max-w-4xl">
        <div class="card-enterprise p-8 md:p-12">
            <form action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" method="POST">
                @csrf
                @if(isset($service))
                    @method('PUT')
                @endif

                <div class="space-y-8">
                    <!-- Service Details -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-2 border-b border-slate-50">
                            <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center text-blue-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <h4 class="font-bold text-slate-800 uppercase tracking-tight text-sm">Asset Configuration</h4>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2">Service Name</label>
                            <input type="text" name="name" value="{{ $service->name ?? old('name') }}" class="premium-input w-full" placeholder="e.g. Premium Cat Grooming" required>
                            @error('name') <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-2">Service Category</label>
                                <select name="type" class="premium-input w-full" required>
                                    <option value="vet_clinic" {{ (isset($service) && $service->type == 'vet_clinic') ? 'selected' : '' }}>Vet Clinic</option>
                                    <option value="grooming" {{ (isset($service) && $service->type == 'grooming') ? 'selected' : '' }}>Grooming</option>
                                    <option value="pet_hotel" {{ (isset($service) && $service->type == 'pet_hotel') ? 'selected' : '' }}>Pet Hotel</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-2">Base Price (IDR)</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-xs pointer-events-none">Rp</span>
                                    <input type="number" name="price" value="{{ $service->price ?? old('price') }}" class="premium-input w-full pl-10 font-bold text-blue-600" placeholder="0" required>
                                </div>
                                @error('price') <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-8 border-t border-slate-100">
                        <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-widest">Abort Deployment</a>
                        <button type="submit" class="btn-mewah">
                            {{ isset($service) ? 'Apply Sync' : 'Deploy Asset' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
