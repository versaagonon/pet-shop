<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['owner_id', 'appointment_id', 'code', 'total_amount', 'description', 'status'];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
