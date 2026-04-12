<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">Edit Owner</h2>
            <p class="vethub-breadcrumb">Clients / Owners / Edit</p>
        </div>
    </x-slot>

    <div style="max-width:640px;">
        <div class="stat-card-vethub">
            <form action="{{ route('doctor.owners.update', $owner) }}" method="POST">
                @csrf @method('PUT')

                <div style="display:flex;flex-direction:column;gap:16px;">
                    <div>
                        <label>Name</label>
                        <input type="text" name="name" value="{{ old('name', $owner->name) }}" required>
                        @error('name') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label>Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone', $owner->phone) }}" required>
                            @error('phone') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email', $owner->email) }}">
                            @error('email') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div>
                        <label>Address</label>
                        <textarea name="address" rows="3">{{ old('address', $owner->address) }}</textarea>
                        @error('address') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:16px;border-top:1px solid var(--border-light);">
                    <a href="{{ route('doctor.owners.index') }}" class="btn-outline">Cancel</a>
                    <button type="submit" class="btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
