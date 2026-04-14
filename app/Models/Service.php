<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'category_name',
        'name',
        'description',
        'price',
        'duration',
        'status',
    ];
}
