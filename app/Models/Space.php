<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'capacity',
        'dimensions',
        'location',
        'sub_location',
        'price_hourly',
        'price_3_hours',
        'price_6_hours',
        'price_daily',
        'price_weekly',
        'price_monthly',
        'amenities',
        'description',
        'image',
        'is_active',
    ];

    protected $casts = [
        'price_hourly' => 'decimal:2',
        'price_3_hours' => 'decimal:2',
        'price_6_hours' => 'decimal:2',
        'price_daily' => 'decimal:2',
        'price_weekly' => 'decimal:2',
        'price_monthly' => 'decimal:2',
        'amenities' => 'array', // Cast JSON to array automatically
        'is_active' => 'boolean',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function unavailableDates()
    {
        return $this->hasMany(UnavailableDate::class);
    }
}
