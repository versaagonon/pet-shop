<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">{{ isset($pet) ? 'Ubah Hewan' : 'Tambah Hewan' }}</h2>
            <p class="vethub-breadcrumb">Pasien / {{ isset($pet) ? 'Ubah' : 'Tambah Baru' }}</p>
        </div>
    </x-slot>

    <div style="max-width:640px;">
        <div class="stat-card-vethub">
            <form action="{{ isset($pet) ? route('doctor.pets.update', $pet) : route('doctor.pets.store') }}" method="POST">
                @csrf
                @if(isset($pet)) @method('PUT') @endif

                <div style="display:flex;flex-direction:column;gap:16px;">
                    <div>
                        <label>Pemilik</label>
                        <select name="owner_id" required>
                            <option value="">Pilih Pemilik</option>
                            @foreach($owners as $owner)
                                <option value="{{ $owner->id }}" {{ (isset($pet) && $pet->owner_id == $owner->id) || old('owner_id') == $owner->id ? 'selected' : '' }}>{{ $owner->name }}</option>
                            @endforeach
                        </select>
                        @error('owner_id') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label>Nama Hewan</label>
                            <input type="text" name="name" value="{{ $pet->name ?? old('name') }}" placeholder="cth. Snowy" required>
                            @error('name') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label>Jenis</label>
                            <select name="type" required>
                                <option value="cat" {{ (isset($pet) && $pet->type == 'cat') ? 'selected' : '' }}>Kucing</option>
                                <option value="dog" {{ (isset($pet) && $pet->type == 'dog') ? 'selected' : '' }}>Anjing</option>
                                <option value="bird" {{ (isset($pet) && $pet->type == 'bird') ? 'selected' : '' }}>Burung</option>
                                <option value="other" {{ (isset($pet) && $pet->type == 'other') ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;">
                        <div>
                            <label>Ras</label>
                            <input type="text" name="breed" value="{{ $pet->breed ?? old('breed') }}" placeholder="cth. Persia">
                        </div>
                        <div>
                            <label>Umur</label>
                            <input type="text" name="age" value="{{ $pet->age ?? old('age') }}" placeholder="cth. 2 tahun">
                        </div>
                        <div>
                            <label>Jenis Kelamin</label>
                            <select name="gender">
                                <option value="male" {{ (isset($pet) && $pet->gender == 'male') ? 'selected' : '' }}>Jantan</option>
                                <option value="female" {{ (isset($pet) && $pet->gender == 'female') ? 'selected' : '' }}>Betina</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:16px;border-top:1px solid var(--border-light);">
                    <a href="{{ route('doctor.pets.index') }}" class="btn-outline">Batal</a>
                    <button type="submit" class="btn-primary">{{ isset($pet) ? 'Simpan Perubahan' : 'Tambah Hewan' }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
