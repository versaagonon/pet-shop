<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">Create Invoice</h2>
            <p class="vethub-breadcrumb">Invoices / Create New</p>
        </div>
    </x-slot>
    <div style="max-width:640px;">
        <div class="stat-card-vethub">
            <form action="{{ route('admin.invoices.store') }}" method="POST">
                @csrf
                <div style="display:flex;flex-direction:column;gap:16px;">

                    @if($appointments->count() > 0)
                    <div style="background:var(--primary-light);padding:12px 16px;border-radius:var(--radius);border:1px solid #dbeafe;">
                        <label style="color:#1e40af;font-weight:700;font-size:13px;margin-bottom:8px;display:block;">📋 Link to Appointment (Pharmacy stage)</label>
                        <select name="appointment_id" id="appointmentSelect" onchange="autofillOwner()">
                            <option value="">— Manual Invoice (no appointment) —</option>
                            @foreach($appointments as $apt)
                                <option value="{{ $apt->id }}" data-owner-id="{{ $apt->pet->owner->id }}">
                                    {{ \Carbon\Carbon::parse($apt->appointment_at)->format('d M Y H:i') }} — {{ $apt->pet->name }} ({{ $apt->pet->owner->name }}) — {{ ucfirst($apt->type) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div>
                        <label>Owner</label>
                        <select name="owner_id" id="ownerSelect" required>
                            <option value="">Select Owner</option>
                            @foreach($owners as $owner)
                                <option value="{{ $owner->id }}" {{ old('owner_id') == $owner->id ? 'selected' : '' }}>{{ $owner->name }}</option>
                            @endforeach
                        </select>
                        @error('owner_id') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label>Description</label>
                        <textarea name="description" rows="2" placeholder="Service details, prescription items, etc.">{{ old('description') }}</textarea>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label>Total Amount (IDR)</label>
                            <input type="number" name="total_amount" value="{{ old('total_amount') }}" placeholder="0" min="0" required>
                            @error('total_amount') <p style="color:var(--danger);font-size:12px;margin-top:4px;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label>Status</label>
                            <select name="status" required>
                                <option value="unpaid">Unpaid</option>
                                <option value="paid">Paid</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:16px;border-top:1px solid var(--border-light);">
                    <a href="{{ route('admin.invoices.index') }}" class="btn-outline">Cancel</a>
                    <button type="submit" class="btn-primary">Create Invoice</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function autofillOwner() {
        const sel = document.getElementById('appointmentSelect');
        const opt = sel.options[sel.selectedIndex];
        const ownerId = opt.getAttribute('data-owner-id');
        if (ownerId) {
            document.getElementById('ownerSelect').value = ownerId;
        }
    }
    </script>
</x-app-layout>
