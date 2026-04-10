<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['owner_id', 'code', 'total_amount', 'status'];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}
