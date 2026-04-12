<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Pet;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'booking');

        $appointments = Appointment::with(['pet.owner', 'doctor'])
            ->where('status', $status)
            ->latest('appointment_at')
            ->get();

        $counts = [];
        foreach (Appointment::STATUSES as $s) {
            $counts[$s] = Appointment::where('status', $s)->count();
        }

        return view('doctor.appointments.index', compact('appointments', 'status', 'counts'));
    }

    public function create()
    {
        $pets = Pet::with('owner')->get();
        return view('doctor.appointments.create', compact('pets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'type' => 'required|in:vet,grooming,pet_hotel',
            'appointment_at' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        Appointment::create([
            'pet_id' => $request->pet_id,
            'type' => $request->type,
            'appointment_at' => $request->appointment_at,
            'notes' => $request->notes,
            'status' => Appointment::STATUS_BOOKING,
            'doctor_id' => auth()->id(),
        ]);

        return redirect()->route('doctor.appointments.index', ['status' => 'booking'])
            ->with('success', 'Appointment created successfully.');
    }

    public function edit(Appointment $appointment)
    {
        $pets = Pet::with('owner')->get();
        return view('doctor.appointments.edit', compact('appointment', 'pets'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'type' => 'required|in:vet,grooming,pet_hotel',
            'appointment_at' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $appointment->update([
            'pet_id' => $request->pet_id,
            'type' => $request->type,
            'appointment_at' => $request->appointment_at,
            'notes' => $request->notes,
        ]);

        return redirect()->route('doctor.appointments.index', ['status' => $appointment->status])
            ->with('success', 'Appointment updated.');
    }

    /**
     * Advance appointment to the next status in the clinical flow.
     */
    public function updateStatus(Request $request, Appointment $appointment)
    {
        $nextStatus = $appointment->next_status;

        if (!$nextStatus) {
            return back()->with('error', 'Cannot advance this appointment further.');
        }

        $appointment->update(['status' => $nextStatus]);

        return redirect()->route('doctor.appointments.index', ['status' => $nextStatus])
            ->with('success', 'Appointment moved to ' . ucfirst($nextStatus) . '.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->update(['status' => Appointment::STATUS_CANCELLED]);
        return redirect()->route('doctor.appointments.index')
            ->with('success', 'Appointment cancelled.');
    }
}
