<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 style="font-size:22px;font-weight:700;margin:0;">Dasbor</h2>
            <p class="vethub-breadcrumb">Beranda / Dashboard</p>
        </div>
    </x-slot>

    <!-- Stats Cards -->
    <div class="stat-card-grid" style="margin-bottom:24px;">
        <div class="stat-card-vethub">
            <div class="stat-title">Total Pendapatan</div>
            <div class="stat-value">Rp {{ number_format($total_revenue, 0, ',', '.') }}</div>
            <a href="{{ route('admin.invoices.index') }}" style="font-size:12px;color:var(--primary);text-decoration:none;">Lihat Detail →</a>
        </div>
        <div class="stat-card-vethub">
            <div class="stat-title">Pendapatan Bulanan</div>
            <div class="stat-value">Rp {{ number_format($monthly_revenue, 0, ',', '.') }}</div>
            <span style="font-size:12px;color:var(--text-muted);">Bulan ini</span>
        </div>
        <div class="stat-card-vethub">
            <div class="stat-title">Pemilik Baru</div>
            <div class="stat-value">{{ $new_owners_count }}</div>
            <span style="font-size:12px;color:var(--text-muted);">Bulan ini</span>
        </div>
        <div class="stat-card-vethub">
            <div class="stat-title">Hewan Baru</div>
            <div class="stat-value">{{ $new_pets_count }}</div>
            <span style="font-size:12px;color:var(--text-muted);">Bulan ini</span>
        </div>
    </div>

    <!-- Chart + Activity -->
    <div style="display:grid;grid-template-columns:2fr 1fr;gap:20px;">
        <div class="stat-card-vethub">
            <h4 style="font-size:16px;font-weight:600;margin:0 0 16px;">Ringkasan Pertumbuhan Klien</h4>
            <div style="height:280px;">
                <canvas id="growthChart"></canvas>
            </div>
        </div>
        <div class="stat-card-vethub">
            <h4 style="font-size:16px;font-weight:600;margin:0 0 16px;">Aktivitas Terbaru</h4>
            @forelse($recent_activities as $activity)
            <div style="display:flex;gap:10px;padding:8px 0;border-bottom:1px solid var(--border-light);">
                <div style="width:8px;height:8px;border-radius:50%;background:var(--primary);margin-top:6px;flex-shrink:0;"></div>
                <div>
                    <div style="font-size:13px;font-weight:600;color:var(--text-dark);">{{ $activity->pet->name }}</div>
                    <div style="font-size:12px;color:var(--text-muted);">{{ Str::limit($activity->diagnosis, 40) }}</div>
                    <div style="font-size:11px;color:var(--text-muted);">{{ Carbon\Carbon::parse($activity->date)->format('d/m/Y') }}</div>
                </div>
            </div>
            @empty
            <div class="table-empty">Tidak ada aktivitas terbaru</div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        new Chart(document.getElementById('growthChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [
                    { label: 'Pemilik', data: {!! json_encode($owner_growth) !!}, borderColor: '#3b82f6', backgroundColor: 'rgba(59,130,246,0.08)', fill: true, tension: 0.4, pointRadius: 3, borderWidth: 2 },
                    { label: 'Hewan', data: {!! json_encode($pet_growth) !!}, borderColor: '#ef4444', backgroundColor: 'rgba(239,68,68,0.05)', fill: true, tension: 0.4, pointRadius: 3, borderWidth: 2 }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { position: 'top', labels: { font: { family: 'Inter', size: 12 } } } },
                scales: {
                    x: { grid: { color: '#f3f4f6' }, ticks: { font: { family: 'Inter', size: 11 } } },
                    y: { grid: { color: '#f3f4f6' }, ticks: { font: { family: 'Inter', size: 11 }, stepSize: 1 }, beginAtZero: true }
                }
            }
        });
    });
    </script>
</x-app-layout>
