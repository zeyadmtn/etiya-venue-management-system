<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'deposit_price',
        'total_payment',
        'student_id',
        'venue_id',
        'status',
        'num_of_days_booked',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id', 'id');
    }
}
