<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Owner;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('owner')->latest()->get();
        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $owners = Owner::with('pets')->get();
        return view('admin.invoices.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'owner_id' => 'required|exists:owners,id',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:paid,unpaid',
        ]);

        $invoice = Invoice::create([
            'owner_id' => $request->owner_id,
            'total_amount' => $request->total_amount,
            'status' => $request->status,
            'code' => 'INV-' . strtoupper(Str::random(8)),
        ]);

        return redirect()->route('admin.invoices.index')->with('success', 'Invoice generated successfully.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['owner.pets']);
        return view('admin.invoices.show', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $invoice->update(['status' => 'paid']);
        return back()->with('success', 'Invoice marked as paid.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('admin.invoices.index')->with('success', 'Invoice deleted.');
    }
}
