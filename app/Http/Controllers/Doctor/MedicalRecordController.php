<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\Pet;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $records = MedicalRecord::with(['pet.owner', 'doctor'])->latest()->get();
        return view('doctor.medical_records.index', compact('records'));
    }

    public function create(Request $request)
    {
        $selectedPet = null;
        if ($request->has('pet_id')) {
            $selectedPet = Pet::find($request->pet_id);
        }
        $pets = Pet::with('owner')->get();
        return view('doctor.medical_records.create', compact('pets', 'selectedPet'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'date' => 'required|date',
        ]);

        MedicalRecord::create([
            'pet_id' => $request->pet_id,
            'user_id' => auth()->id(),
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
            'date' => $request->date,
        ]);

        return redirect()->route('doctor.medical_records.index')->with('success', 'Medical record added.');
    }

    public function show(MedicalRecord $medicalRecord)
    {
        $medicalRecord->load(['pet.owner', 'doctor']);
        return view('doctor.medical_records.show', compact('medicalRecord'));
    }

    public function edit(MedicalRecord $medicalRecord)
    {
        $pets = Pet::with('owner')->get();
        return view('doctor.medical_records.edit', compact('medicalRecord', 'pets'));
    }

    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'date' => 'required|date',
        ]);

        $medicalRecord->update($request->all());

        return redirect()->route('doctor.medical_records.index')->with('success', 'Medical record updated.');
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();
        return redirect()->route('doctor.medical_records.index')->with('success', 'Medical record deleted.');
    }
}
