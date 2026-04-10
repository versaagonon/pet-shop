<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('doctor.dashboard');
    })->name('dashboard');

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'admin'])->name('dashboard');

        Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
        Route::resource('invoices', \App\Http\Controllers\Admin\InvoiceController::class);
        Route::get('/history', [\App\Http\Controllers\Admin\HistoryController::class, 'index'])->name('history.index');
        Route::get('/history/pet/{pet}', [\App\Http\Controllers\Admin\HistoryController::class, 'show'])->name('history.show');
    });

    // Doctor Routes
    Route::middleware(['role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'doctor'])->name('dashboard');

        Route::resource('owners', \App\Http\Controllers\Doctor\OwnerController::class);
        Route::resource('pets', \App\Http\Controllers\Doctor\PetController::class);
        Route::resource('appointments', \App\Http\Controllers\Doctor\AppointmentController::class);
        Route::resource('medical-records', \App\Http\Controllers\Doctor\MedicalRecordController::class);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
