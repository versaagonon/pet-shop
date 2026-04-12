<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">{{ isset($owner) ? 'Edit Owner' : 'Add Owner' }}</h2>
            <p class="vethub-breadcrumb">Clients / Owners / {{ isset($owner) ? 'Edit' : 'Add New' }}</p>
        </div>
    </x-slot>

    <div style="max-width:640px;">
        <div class="stat-card-vethub">
            <form action="{{ isset($owner) ? route('doctor.owners.update', $owner) : route('doctor.owners.store') }}" method="POST">
                @csrf
                @if(isset($owner)) @method('PUT') @endif

                <div style="display:flex;flex-direction:column;gap:16px;">
                    <div>
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $owner->name ?? old('name') }}" placeholder="Full name" required>
                        @error('name') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label>Phone Number</label>
                            <input type="text" name="phone" value="{{ $owner->phone ?? old('phone') }}" placeholder="08xxxxxxxxxx" required>
                            @error('phone') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="email" name="email" value="{{ $owner->email ?? old('email') }}" placeholder="email@example.com">
                            @error('email') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div>
                        <label>Address</label>
                        <textarea name="address" rows="3" placeholder="Full address">{{ $owner->address ?? old('address') }}</textarea>
                        @error('address') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:16px;border-top:1px solid var(--border-light);">
                    <a href="{{ route('doctor.owners.index') }}" class="btn-outline">Cancel</a>
                    <button type="submit" class="btn-primary">{{ isset($owner) ? 'Save Changes' : 'Add Owner' }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
