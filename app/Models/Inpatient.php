<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inpatient extends Model
{
    protected $fillable = [
        'pet_id',
        'doctor_id',
        'room_number',
        'diagnosis',
        'treatment_plan',
        'status',
        'admission_date',
        'discharge_date',
    ];
    protected $casts = [
        'admission_date' => 'datetime',
        'discharge_date' => 'datetime',
    ];
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
