<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Inpatient;
use App\Models\Pet;
use Illuminate\Http\Request;

class InpatientController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'active');
        $inpatients = Inpatient::with(['pet.owner', 'doctor'])
            ->where('status', $status)
            ->latest('admission_date')
            ->get();

        return view('doctor.inpatients.index', compact('inpatients', 'status'));
    }

    public function create()
    {
        $pets = Pet::with('owner')->get();
        return view('doctor.inpatients.create', compact('pets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'room_number' => 'nullable|string',
            'diagnosis' => 'required|string',
            'treatment_plan' => 'required|string',
        ]);

        Inpatient::create([
            'pet_id' => $request->pet_id,
            'doctor_id' => auth()->id(),
            'room_number' => $request->room_number,
            'diagnosis' => $request->diagnosis,
            'treatment_plan' => $request->treatment_plan,
            'status' => 'active',
            'admission_date' => now(),
        ]);

        return redirect()->route('doctor.inpatients.index')
            ->with('success', 'Pasien berhasil didaftarkan ke Rawat Inap.');
    }

    public function edit(Inpatient $inpatient)
    {
        return view('doctor.inpatients.edit', compact('inpatient'));
    }

    public function update(Request $request, Inpatient $inpatient)
    {
        $request->validate([
            'room_number' => 'nullable|string',
            'diagnosis' => 'required|string',
            'treatment_plan' => 'required|string',
            'status' => 'required|in:active,discharged',
        ]);

        $data = [
            'room_number' => $request->room_number,
            'diagnosis' => $request->diagnosis,
            'treatment_plan' => $request->treatment_plan,
            'status' => $request->status,
        ];

        if ($request->status === 'discharged' && $inpatient->status === 'active') {
            $data['discharge_date'] = now();
        }

        $inpatient->update($data);

        return redirect()->route('doctor.inpatients.index')
            ->with('success', 'data rawat inap berhasil diperbarui.');
    }
}
