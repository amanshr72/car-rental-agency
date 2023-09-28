<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_model',
        'vehicle_number',
        'seating_capacity',
        'rent_per_day',
    ];
}
