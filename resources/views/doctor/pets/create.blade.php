<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">{{ isset($pet) ? 'Edit Pet' : 'Add Pet' }}</h2>
            <p class="vethub-breadcrumb">Patients / {{ isset($pet) ? 'Edit' : 'Add New' }}</p>
        </div>
    </x-slot>

    <div style="max-width:640px;">
        <div class="stat-card-vethub">
            <form action="{{ isset($pet) ? route('doctor.pets.update', $pet) : route('doctor.pets.store') }}" method="POST">
                @csrf
                @if(isset($pet)) @method('PUT') @endif

                <div style="display:flex;flex-direction:column;gap:16px;">
                    <div>
                        <label>Owner</label>
                        <select name="owner_id" required>
                            <option value="">Select Owner</option>
                            @foreach($owners as $owner)
                                <option value="{{ $owner->id }}" {{ (isset($pet) && $pet->owner_id == $owner->id) || old('owner_id') == $owner->id ? 'selected' : '' }}>{{ $owner->name }}</option>
                            @endforeach
                        </select>
                        @error('owner_id') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label>Pet Name</label>
                            <input type="text" name="name" value="{{ $pet->name ?? old('name') }}" placeholder="e.g. Snowy" required>
                            @error('name') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label>Type</label>
                            <select name="type" required>
                                <option value="cat" {{ (isset($pet) && $pet->type == 'cat') ? 'selected' : '' }}>Cat</option>
                                <option value="dog" {{ (isset($pet) && $pet->type == 'dog') ? 'selected' : '' }}>Dog</option>
                                <option value="bird" {{ (isset($pet) && $pet->type == 'bird') ? 'selected' : '' }}>Bird</option>
                                <option value="other" {{ (isset($pet) && $pet->type == 'other') ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;">
                        <div>
                            <label>Breed</label>
                            <input type="text" name="breed" value="{{ $pet->breed ?? old('breed') }}" placeholder="e.g. Persian">
                        </div>
                        <div>
                            <label>Age</label>
                            <input type="text" name="age" value="{{ $pet->age ?? old('age') }}" placeholder="e.g. 2 years">
                        </div>
                        <div>
                            <label>Gender</label>
                            <select name="gender">
                                <option value="male" {{ (isset($pet) && $pet->gender == 'male') ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ (isset($pet) && $pet->gender == 'female') ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:16px;border-top:1px solid var(--border-light);">
                    <a href="{{ route('doctor.pets.index') }}" class="btn-outline">Cancel</a>
                    <button type="submit" class="btn-primary">{{ isset($pet) ? 'Save Changes' : 'Add Pet' }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
