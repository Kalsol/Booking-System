<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appearance extends Model
{
    protected $fillable = [
        'logo',
        'primary_color',
        'secondary_color',
        'theme',
    ];
}
