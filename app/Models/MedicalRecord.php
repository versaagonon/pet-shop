<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = ['pet_id', 'user_id', 'diagnosis', 'treatment', 'date'];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'medical_record_medicine')
                    ->withPivot('quantity', 'dosage')
                    ->withTimestamps();
    }
}
