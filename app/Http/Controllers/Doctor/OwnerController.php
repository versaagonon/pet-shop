<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Owner::latest()->get();
        return view('doctor.owners.index', compact('owners'));
    }

    public function create()
    {
        return view('doctor.owners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'email' => 'nullable|email|max:255',
        ]);

        Owner::create($request->all());

        return redirect()->route('doctor.owners.index')->with('success', 'Owner created successfully.');
    }

    public function edit(Owner $owner)
    {
        return view('doctor.owners.edit', compact('owner'));
    }

    public function update(Request $request, Owner $owner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'email' => 'nullable|email|max:255',
        ]);

        $owner->update($request->all());

        return redirect()->route('doctor.owners.index')->with('success', 'Owner updated successfully.');
    }

    public function destroy(Owner $owner)
    {
        $owner->delete();
        return redirect()->route('doctor.owners.index')->with('success', 'Owner deleted successfully.');
    }
}
