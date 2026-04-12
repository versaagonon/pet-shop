<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\Medicine;
use App\Models\Pet;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $medicalRecords = MedicalRecord::with(['pet.owner', 'doctor', 'medicines'])->latest()->get();
        return view('doctor.medical_records.index', compact('medicalRecords'));
    }

    public function create(Request $request)
    {
        $selectedPet = null;
        if ($request->has('pet_id')) {
            $selectedPet = Pet::find($request->pet_id);
        }
        $pets = Pet::with('owner')->get();
        $medicines = Medicine::orderBy('name')->get();
        return view('doctor.medical_records.create', compact('pets', 'selectedPet', 'medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'date' => 'required|date',
            'medicines' => 'nullable|array',
            'medicines.*.id' => 'required_with:medicines|exists:medicines,id',
            'medicines.*.quantity' => 'required_with:medicines|integer|min:1',
            'medicines.*.dosage' => 'nullable|string',
        ]);

        $record = MedicalRecord::create([
            'pet_id' => $request->pet_id,
            'user_id' => auth()->id(),
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
            'date' => $request->date,
        ]);

        // Sync medicines
        if ($request->has('medicines')) {
            foreach ($request->medicines as $med) {
                if (!empty($med['id'])) {
                    $record->medicines()->attach($med['id'], [
                        'quantity' => $med['quantity'] ?? 1,
                        'dosage' => $med['dosage'] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('doctor.medical-records.index')->with('success', 'Medical record added.');
    }

    public function show(MedicalRecord $medicalRecord)
    {
        $medicalRecord->load(['pet.owner', 'doctor', 'medicines']);
        return view('doctor.medical_records.show', compact('medicalRecord'));
    }

    public function edit(MedicalRecord $medicalRecord)
    {
        $medicalRecord->load('medicines');
        $pets = Pet::with('owner')->get();
        $medicines = Medicine::orderBy('name')->get();
        return view('doctor.medical_records.edit', compact('medicalRecord', 'pets', 'medicines'));
    }

    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'date' => 'required|date',
            'medicines' => 'nullable|array',
            'medicines.*.id' => 'required_with:medicines|exists:medicines,id',
            'medicines.*.quantity' => 'required_with:medicines|integer|min:1',
            'medicines.*.dosage' => 'nullable|string',
        ]);

        $medicalRecord->update($request->only(['pet_id', 'diagnosis', 'treatment', 'date']));

        // Re-sync medicines
        $syncData = [];
        if ($request->has('medicines')) {
            foreach ($request->medicines as $med) {
                if (!empty($med['id'])) {
                    $syncData[$med['id']] = [
                        'quantity' => $med['quantity'] ?? 1,
                        'dosage' => $med['dosage'] ?? null,
                    ];
                }
            }
        }
        $medicalRecord->medicines()->sync($syncData);

        return redirect()->route('doctor.medical-records.index')->with('success', 'Medical record updated.');
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->medicines()->detach();
        $medicalRecord->delete();
        return redirect()->route('doctor.medical-records.index')->with('success', 'Medical record deleted.');
    }
}
