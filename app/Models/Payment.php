<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'appointment_id',
        'customer_id',
        'amount',
        'status',
        'method',
        'transaction_ref',
        'paid_at',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
