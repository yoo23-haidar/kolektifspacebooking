<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'guest_name',
        'guest_email',
        'guest_whatsapp',
        'company_name',
        'space_id',
        'booking_date',
        'start_time',
        'end_time',
        'duration',
        'duration_unit',
        'total_guests',
        'total_price',
        'status',
        'payment_status',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'guest_info' => 'array',
        'total_price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function space()
    {
        return $this->belongsTo(Space::class);
    }
}
