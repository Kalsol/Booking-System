<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $fillable = [
        'customer_id',
        'appointment_id',
        'total_amount',
        'status',
        'due_date',
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
