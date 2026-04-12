<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:12px;"
            class="no-print">
            <div>
                <h2 style="font-size:22px;font-weight:700;margin:0;">Invoice Detail</h2>
                <p class="vethub-breadcrumb">Invoices / Detail</p>
            </div>
            <div style="display:flex;gap:8px;">
                <button onclick="window.print()" class="btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2 2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                        </path>
                    </svg>
                    Print
                </button>
                <a href="{{ route('admin.invoices.index') }}" class="btn-outline">Back to List</a>
            </div>
        </div>
    </x-slot>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }
        }
    </style>

    <div style="max-width:800px;">
        <div class="stat-card-vethub" style="padding:40px;">
            <!-- Header -->
            <div
                style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:32px;padding-bottom:24px;border-bottom:2px solid var(--border-color);">
                <div>
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:4px;">
                        <div
                            style="width:40px;height:40px;background:var(--primary);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                            <svg width="20" height="20" fill="#fff" viewBox="0 0 24 24">
                                <path
                                    d="M4.5 12.75a.75.75 0 010-1.5h2.25V9a.75.75 0 011.5 0v2.25H10.5a.75.75 0 010 1.5H8.25V15a.75.75 0 01-1.5 0v-2.25H4.5z" />
                            </svg>
                        </div>
                        <div>
                            <div style="font-size:20px;font-weight:700;color:var(--text-dark);">VetHub</div>
                            <div style="font-size:11px;color:var(--text-muted);">Pet Clinic Management</div>
                        </div>
                    </div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:12px;color:var(--text-muted);margin-bottom:4px;">Invoice Reference</div>
                    <div style="font-size:20px;font-weight:700;color:var(--text-dark);">
                        INV-{{ str_pad($invoice->id, 6, '0', STR_PAD_LEFT) }}</div>
                    <div style="font-size:12px;color:var(--text-muted);margin-top:4px;">
                        {{ \Carbon\Carbon::parse($invoice->created_at)->format('d M Y') }}</div>
                </div>
            </div>

            <!-- Bill To -->
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:32px;">
                <div>
                    <div
                        style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;margin-bottom:8px;">
                        Bill To</div>
                    <div style="font-size:16px;font-weight:700;color:var(--text-dark);">{{ $invoice->owner->name }}
                    </div>
                    <div style="font-size:13px;color:var(--text-body);margin-top:4px;">{{ $invoice->owner->phone }}
                    </div>
                    <div style="font-size:12px;color:var(--text-muted);margin-top:4px;">{{ $invoice->owner->address }}
                    </div>
                </div>
                <div style="text-align:right;">
                    <div
                        style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;margin-bottom:8px;">
                        Status</div>
                    <span class="badge {{ $invoice->status === 'paid' ? 'badge-paid' : 'badge-unpaid' }}"
                        style="font-size:12px;padding:4px 14px;">
                        {{ $invoice->status === 'paid' ? 'Paid' : 'Unpaid' }}
                    </span>
                </div>
            </div>

            <!-- Amount -->
            <table class="vethub-table" style="margin-bottom:24px;">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th style="text-align:right;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Clinical & Veterinary Services</td>
                        <td style="text-align:right;font-weight:700;">Rp
                            {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr style="background:var(--primary);color:#fff;">
                        <td style="font-weight:700;padding:16px;">Total</td>
                        <td style="text-align:right;font-weight:700;font-size:18px;padding:16px;">Rp
                            {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-app-layout>