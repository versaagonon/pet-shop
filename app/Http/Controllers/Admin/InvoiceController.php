<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\Owner;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['owner', 'appointment.pet'])->latest()->get();
        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $owners = Owner::with('pets')->get();
        // Show appointments at pharmacy stage that don't have invoices yet
        $appointments = Appointment::with('pet.owner')
            ->where('status', Appointment::STATUS_PHARMACY)
            ->whereDoesntHave('invoice')
            ->get();
        return view('admin.invoices.create', compact('owners', 'appointments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'owner_id' => 'required|exists:owners,id',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:paid,unpaid',
            'appointment_id' => 'nullable|exists:appointments,id',
            'description' => 'nullable|string',
        ]);

        $invoice = Invoice::create([
            'owner_id' => $request->owner_id,
            'appointment_id' => $request->appointment_id,
            'total_amount' => $request->total_amount,
            'description' => $request->description,
            'status' => $request->status,
            'code' => 'INV-' . strtoupper(Str::random(8)),
        ]);

        // If linked to appointment, advance to "payment"
        if ($request->appointment_id) {
            Appointment::where('id', $request->appointment_id)
                ->update(['status' => Appointment::STATUS_PAYMENT]);
        }

        // If already paid, also mark as done
        if ($request->status === 'paid' && $request->appointment_id) {
            Appointment::where('id', $request->appointment_id)
                ->update(['status' => Appointment::STATUS_DONE]);
        }

        return redirect()->route('admin.invoices.index')->with('success', 'Invoice created successfully.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['owner.pets', 'appointment.pet']);
        return view('admin.invoices.show', compact('invoice'));
    }

    /**
     * Mark invoice as paid (manual payment confirmation by admin).
     */
    public function update(Request $request, Invoice $invoice)
    {
        $invoice->update(['status' => 'paid']);

        // Advance linked appointment to "done"
        if ($invoice->appointment_id) {
            Appointment::where('id', $invoice->appointment_id)
                ->update(['status' => Appointment::STATUS_DONE]);
        }

        return back()->with('success', 'Invoice marked as paid.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('admin.invoices.index')->with('success', 'Invoice deleted.');
    }
}
