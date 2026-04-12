<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::latest()->get();
        return view('admin.medicines.index', compact('medicines'));
    }

    public function create()
    {
        return view('admin.medicines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'compositions' => 'nullable|string',
        ]);

        Medicine::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'compositions' => $request->compositions,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.medicines.index')->with('success', 'Mixed Medicine added successfully.');
    }

    public function edit(Medicine $medicine)
    {
        return view('admin.medicines.edit', compact('medicine'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'compositions' => 'nullable|string',
        ]);

        $medicine->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'compositions' => $request->compositions,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.medicines.index')->with('success', 'Mixed Medicine updated.');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('admin.medicines.index')->with('success', 'Mixed Medicine deleted.');
    }
}
