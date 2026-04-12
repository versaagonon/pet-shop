<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    const STATUS_BOOKING   = 'booking';
    const STATUS_ADVENT    = 'advent';
    const STATUS_CHECKUP   = 'checkup';
    const STATUS_PHARMACY  = 'pharmacy';
    const STATUS_PAYMENT   = 'payment';
    const STATUS_DONE      = 'done';
    const STATUS_CANCELLED = 'cancelled';

    const STATUSES = [
        self::STATUS_BOOKING,
        self::STATUS_ADVENT,
        self::STATUS_CHECKUP,
        self::STATUS_PHARMACY,
        self::STATUS_PAYMENT,
        self::STATUS_DONE,
        self::STATUS_CANCELLED,
    ];

    // Flow order for Doctor (clinical steps)
    const DOCTOR_FLOW = [
        self::STATUS_BOOKING  => self::STATUS_ADVENT,
        self::STATUS_ADVENT   => self::STATUS_CHECKUP,
        self::STATUS_CHECKUP  => self::STATUS_PHARMACY,
    ];

    protected $fillable = ['pet_id', 'type', 'appointment_at', 'status', 'notes', 'doctor_id'];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function getNextStatusAttribute()
    {
        return self::DOCTOR_FLOW[$this->status] ?? null;
    }
}
