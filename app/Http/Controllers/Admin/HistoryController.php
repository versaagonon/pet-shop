<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $pets = Pet::with(['owner', 'medicalRecords.doctor', 'appointments'])->latest()->get();
        return view('admin.history.index', compact('pets'));
    }

    public function show(Pet $pet)
    {
        $pet->load(['owner', 'medicalRecords.doctor', 'appointments']);
        return view('admin.history.show', compact('pet'));
    }
}
