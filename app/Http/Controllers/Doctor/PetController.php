<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Owner;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with('owner')->latest()->get();
        return view('doctor.pets.index', compact('pets'));
    }

    public function create()
    {
        $owners = Owner::all();
        return view('doctor.pets.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'owner_id' => 'required|exists:owners,id',
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'breed' => 'nullable|string',
            'age' => 'nullable|string',
            'gender' => 'nullable|string',
        ]);

        Pet::create($request->all());

        return redirect()->route('doctor.pets.index')->with('success', 'Pet created successfully.');
    }

    public function edit(Pet $pet)
    {
        $owners = Owner::all();
        return view('doctor.pets.edit', compact('pet', 'owners'));
    }

    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'owner_id' => 'required|exists:owners,id',
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'breed' => 'nullable|string',
            'age' => 'nullable|string',
            'gender' => 'nullable|string',
        ]);

        $pet->update($request->all());

        return redirect()->route('doctor.pets.index')->with('success', 'Pet updated successfully.');
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();
        return redirect()->route('doctor.pets.index')->with('success', 'Pet deleted successfully.');
    }
}
