<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'rental_days',
        'start_date',
        'end_date',
        'is_booked',
    ];

    public function car(){
        return $this->belongsTo(Car::class, 'car_id');
    }
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
