<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = ['name', 'description', 'compositions', 'stock', 'price'];

    public function medicalRecords()
    {
        return $this->belongsToMany(MedicalRecord::class, 'medical_record_medicine')
                    ->withPivot('quantity', 'dosage')
                    ->withTimestamps();
    }

    /**
     * Get compositions as array.
     * Format: [{"name":"Injeksi Antiparasit","qty":1}]
     */
    public function getCompositionsArrayAttribute()
    {
        if (!$this->compositions) return [];
        return json_decode($this->compositions, true) ?? [];
    }
}
