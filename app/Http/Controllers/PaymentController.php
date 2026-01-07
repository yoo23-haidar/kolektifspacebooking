<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(Booking $booking)
    {
        // Ensure user can only see their own booking if logged in
        // or add logic for guest token access (omitted for MVP simplicity)

        return view('booking.payment', compact('booking'));
    }
}
