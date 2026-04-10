<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Pet;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('pet.owner')->latest()->get();
        return view('doctor.appointments.index', compact('appointments'));
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
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        Appointment::create($request->all());

        return redirect()->route('doctor.appointments.index')->with('success', 'Appointment scheduled successfully.');
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
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $appointment->update($request->all());

        return redirect()->route('doctor.appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('doctor.appointments.index')->with('success', 'Appointment removed.');
    }
}
