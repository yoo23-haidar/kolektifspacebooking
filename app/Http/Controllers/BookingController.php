<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Space;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'space_id' => 'required|exists:spaces,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $spaceId = $request->space_id;
        $start = Carbon::parse($request->start_time);
        $end = Carbon::parse($request->end_time);

        $isAvailable = $this->isRoomAvailable($spaceId, $start, $end);

        return response()->json([
            'available' => $isAvailable,
            'message' => $isAvailable ? 'Space is available' : 'Space is booked for selected dates',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'space_id' => 'required|exists:spaces,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required', // HH:MM
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email',
            'guest_whatsapp' => 'required|numeric|digits_between:10,14',
            'company_name' => 'required|string|max:255',
            'total_guests' => 'required|integer|min:1|max:20',
            // 'duration' & 'pricing_type' come from form hidden/calc fields
            'duration' => 'required|integer|min:1',
        ]);

        $space = Space::findOrFail($request->space_id);

        // Parse Details
        $start = Carbon::parse($request->booking_date . ' ' . $request->start_time);

        // Business Hours Validation (Start: 09:00 - 21:00)
        $startHour = (int) $start->format('H');
        if ($startHour < 9 || $startHour > 21) {
            return back()->withErrors(['start_time' => 'Bookings must start between 09:00 and 21:00.']);
        }

        // Calculate End Time
        $duration = (int) $request->duration;
        $unit = 'hour';
        $end = $start->copy();

        // ... (Unit Logic Reuse) ...
        $pricingType = $request->pricing_type;
        if ($pricingType == 'hourly') {
            $end->addHours($duration);
        } elseif ($pricingType == '3_hours') {
            $end->addHours(3 * $duration);
            $unit = 'package_3h';
        } elseif ($pricingType == '6_hours') {
            $end->addHours(6 * $duration);
            $unit = 'package_6h';
        } elseif ($pricingType == 'daily') {
            $end->addDays($duration);
            $unit = 'day';
        } elseif ($pricingType == 'weekly') {
            $end->addWeeks($duration);
            $unit = 'week';
        } elseif ($pricingType == 'monthly') {
            $end->addMonths($duration);
            $unit = 'month';
        }

        // Business Hours Validation (End: Must be <= 22:00 for same-day bookings)
        // Note: For daily/weekly, we might check check-in time only, but user asked for "last hour is 9pm til 10pm"
        // This implies hourly bookings.
        if ($pricingType == 'hourly' || str_contains($pricingType, 'hours')) {
            $endHour = (int) $end->format('H');
            // If ends next day (e.g. 23:00 becomes 23), or 00:00. 
            // We need to check if it exceeds 22:00 on the same day, or spills over.
            // Simplest: use carbon comparison with 10PM of start day.
            $limit = $start->copy()->setTime(22, 0, 0);
            if ($end->gt($limit)) {
                return back()->withErrors(['duration' => 'Bookings cannot end after 22:00 (10 PM).']);
            }
        }

        // 1. Re-check Availability
        if (!$this->isRoomAvailable($space->id, $start, $end)) {
            return back()->withErrors(['date' => 'Space is no longer available for these dates/times.']);
        }

        // 2. Calculate Price (Double Check Backend)
        // Re-use logic or trust frontend if simple? better strict calc.
        // Assuming strict calc similar to before but updated for units
        $totalPrice = 0;
        if ($pricingType == 'hourly')
            $totalPrice = $space->price_hourly * $duration;
        elseif ($pricingType == '3_hours')
            $totalPrice = $space->price_3_hours * $duration;
        elseif ($pricingType == '6_hours')
            $totalPrice = $space->price_6_hours * $duration;
        elseif ($pricingType == 'daily')
            $totalPrice = $space->price_daily * $duration;
        elseif ($pricingType == 'weekly')
            $totalPrice = $space->price_weekly * $duration;
        elseif ($pricingType == 'monthly')
            $totalPrice = $space->price_monthly * $duration;

        // 3. Create Booking (Guest)
        $booking = Booking::create([
            'space_id' => $space->id,
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'guest_whatsapp' => $request->guest_whatsapp,
            'company_name' => $request->company_name,
            'total_guests' => $request->total_guests,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $end,
            'duration' => $duration,
            'duration_unit' => $unit,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        return redirect()->route('booking.payment', $booking->id);
    }

    private function isRoomAvailable($spaceId, $start, $end)
    {
        // Check Bookings
        $exists = Booking::where('space_id', $spaceId)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_time', [$start, $end])
                    ->orWhereBetween('end_time', [$start, $end])
                    ->orWhere(function ($q) use ($start, $end) {
                        $q->where('start_time', '<=', $start)
                            ->where('end_time', '>=', $end);
                    });
            })
            ->exists();

        if ($exists)
            return false;

        // Check Unavailable Dates (Maintenance)
        // ... (Similar logic for UnavailableDate model if implemented fully)

        return true;
    }
}
