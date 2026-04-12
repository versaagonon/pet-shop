<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">{{ isset($service) ? 'Edit Service' : 'Add Service' }}</h2>
            <p class="vethub-breadcrumb">Services / {{ isset($service) ? 'Edit' : 'Add New' }}</p>
        </div>
    </x-slot>
    <div style="max-width:640px;">
        <div class="stat-card-vethub">
            <form action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" method="POST">
                @csrf
                @if(isset($service)) @method('PUT') @endif
                <div style="display:flex;flex-direction:column;gap:16px;">
                    <div>
                        <label>Service Name</label>
                        <input type="text" name="name" value="{{ $service->name ?? old('name') }}" placeholder="e.g. Grooming Kombinasi" required>
                        @error('name') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label>Duration</label>
                            <select name="duration" required>
                                <option value="15 Minutes" {{ (isset($service) && $service->duration == '15 Minutes') ? 'selected' : '' }}>15 Minutes</option>
                                <option value="30 Minutes" {{ (isset($service) && $service->duration == '30 Minutes') || !isset($service) ? 'selected' : '' }}>30 Minutes</option>
                                <option value="45 Minutes" {{ (isset($service) && $service->duration == '45 Minutes') ? 'selected' : '' }}>45 Minutes</option>
                                <option value="1 Hours" {{ (isset($service) && $service->duration == '1 Hours') ? 'selected' : '' }}>1 Hours</option>
                                <option value="2 Hours" {{ (isset($service) && $service->duration == '2 Hours') ? 'selected' : '' }}>2 Hours</option>
                                <option value="3 Hours" {{ (isset($service) && $service->duration == '3 Hours') ? 'selected' : '' }}>3 Hours</option>
                            </select>
                        </div>
                        <div>
                            <label>Price (IDR)</label>
                            <input type="number" name="price" value="{{ $service->price ?? old('price') }}" placeholder="0" min="0" required>
                            @error('price') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:16px;border-top:1px solid var(--border-light);">
                    <a href="{{ route('admin.services.index') }}" class="btn-outline">Cancel</a>
                    <button type="submit" class="btn-primary">{{ isset($service) ? 'Save Changes' : 'Add Service' }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
