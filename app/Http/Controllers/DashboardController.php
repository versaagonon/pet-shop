<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\Owner;
use App\Models\Pet;
use App\Models\MedicalRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function admin()
    {
        $now = Carbon::now();
        
        // Revenue calculations
        $total_revenue = Invoice::where('status', 'paid')->sum('total_amount');
        $monthly_revenue = Invoice::where('status', 'paid')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->sum('total_amount');

        // New Registrations this month
        $new_owners_count = Owner::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();
        $new_pets_count = Pet::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        // Chart Data (Last 12 months)
        $months = [];
        $owner_growth = [];
        $pet_growth = [];

        for ($i = 11; $i >= 0; $i--) {
            $monthDate = Carbon::now()->subMonths($i);
            $months[] = $monthDate->format('M');
            
            $owner_growth[] = Owner::whereMonth('created_at', $monthDate->month)
                ->whereYear('created_at', $monthDate->year)
                ->count();
                
            $pet_growth[] = Pet::whereMonth('created_at', $monthDate->month)
                ->whereYear('created_at', $monthDate->year)
                ->count();
        }

        // Recent Activity
        $recent_activities = MedicalRecord::with(['pet.owner', 'doctor'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'total_revenue', 
            'monthly_revenue', 
            'new_owners_count', 
            'new_pets_count', 
            'months', 
            'owner_growth', 
            'pet_growth',
            'recent_activities'
        ));
    }

    public function doctor()
    {
        $today = Carbon::today();

        // Appointment counts for today
        $today_appointments = Appointment::whereDate('appointment_at', $today)->count();
        $vet_count = Appointment::whereDate('appointment_at', $today)
            ->where('type', 'vet')
            ->count();
        $grooming_count = Appointment::whereDate('appointment_at', $today)
            ->where('type', 'grooming')
            ->count();
        $hotel_count = Appointment::whereDate('appointment_at', $today)
            ->where('type', 'pet_hotel')
            ->count();

        // Recent Activity
        $recent_activities = MedicalRecord::with(['pet.owner', 'doctor'])
            ->latest()
            ->take(5)
            ->get();

        return view('doctor.dashboard', compact(
            'today_appointments',
            'vet_count',
            'grooming_count',
            'hotel_count',
            'recent_activities'
        ));
    }
}
