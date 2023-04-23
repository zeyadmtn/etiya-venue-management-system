<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'equipment',
        'deposit_price',
        'daily_rate',
        'images',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
