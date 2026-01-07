<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\Space;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Today's Revenue (Paid bookings created or for today)
        // Let's assume revenue is recognized on the booking_date for simplicity in this MVP
        $todayRevenue = Booking::whereDate('booking_date', Carbon::today())
            ->where('payment_status', 'paid')
            ->sum('total_price');

        // 2. Occupancy (Active Spaces / Total Spaces)
        $totalSpaces = Space::count();
        // Check bookings active NOW: date is today, start_time <= now, end_time >= now
        // Note: end_time is DateTime, start_time is Time. 
        // We can compare against end_time directly if it's a full DateTime.
        $now = Carbon::now();
        $activeBookingsCount = Booking::where('status', 'confirmed')
            ->whereDate('booking_date', Carbon::today())
            ->whereTime('start_time', '<=', $now->format('H:i:s'))
            ->where('end_time', '>=', $now)
            ->count();

        $occupancyRate = $totalSpaces > 0 ? round(($activeBookingsCount / $totalSpaces) * 100) : 0;

        // 3. Guests Expected (Total people in confirmed bookings for today)
        $guestsExpected = Booking::whereDate('booking_date', Carbon::today())
            ->whereIn('status', ['confirmed', 'pending']) // Include pending? Maybe just confirmed. Let's say Confirmed for "Expected".
            ->sum('total_guests');

        // 4. Happening Now (Active Bookings List)
        $activeBookings = Booking::with('space')
            ->where('status', 'confirmed')
            ->whereDate('booking_date', Carbon::today())
            ->whereTime('start_time', '<=', $now->format('H:i:s'))
            ->where('end_time', '>=', $now)
            ->get();

        // 5. Incoming Requests (Latest Pending)
        $incomingRequests = Booking::with('space')
            ->where('status', 'pending')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'todayRevenue',
            'occupancyRate',
            'guestsExpected',
            'activeBookings',
            'incomingRequests'
        ));
    }
}
