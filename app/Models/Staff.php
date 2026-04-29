<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'user_id',
        'role_title',
        'bio',
        'hourly_rate',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
