<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">Patient History</h2>
            <p class="vethub-breadcrumb">Admin / Patient History</p>
        </div>
    </x-slot>

    <div style="margin-bottom:16px;">
        <input type="text" id="patientSearch" placeholder="Search pet or owner name..." onkeyup="filterPatients()" style="max-width:320px;">
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px;" id="patientList">
        @foreach($pets as $pet)
        <div class="stat-card-vethub patient-item" data-name="{{ strtolower($pet->name) }} {{ strtolower($pet->owner->name) }}">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px;">
                <div>
                    <h3 style="font-size:16px;font-weight:700;margin:0;">{{ $pet->name }}</h3>
                    <span style="font-size:12px;color:var(--text-muted);">{{ ucfirst($pet->type) }}</span>
                </div>
                <span class="badge badge-completed">{{ ucfirst($pet->gender) }}</span>
            </div>
            <div style="border-top:1px solid var(--border-light);padding-top:10px;margin-bottom:12px;">
                <div style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;">Owner</div>
                <div style="font-weight:600;">{{ $pet->owner->name }}</div>
                <div style="font-size:12px;color:var(--text-muted);">{{ $pet->owner->phone }}</div>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:13px;margin-bottom:12px;">
                <span>Med Records: <strong>{{ $pet->medicalRecords->count() }}</strong></span>
                <span>Appointments: <strong>{{ $pet->appointments->count() }}</strong></span>
            </div>
            <a href="{{ route('admin.history.show', $pet) }}" class="btn-primary" style="width:100%;text-align:center;display:block;font-size:13px;">
                View Full History
            </a>
        </div>
        @endforeach
    </div>

    <script>
    function filterPatients() {
        let input = document.getElementById('patientSearch').value.toLowerCase();
        let items = document.getElementsByClassName('patient-item');
        for (let item of items) {
            item.style.display = item.getAttribute('data-name').includes(input) ? '' : 'none';
        }
    }
    </script>
</x-app-layout>
