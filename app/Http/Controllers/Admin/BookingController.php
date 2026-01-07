<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::latest();

        // Filter by Status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by Space
        if ($request->filled('space_id')) {
            $query->where('space_id', $request->space_id);
        }

        $bookings = $query->get();
        $spaces = \App\Models\Space::all();

        return view('admin.bookings.index', compact('bookings', 'spaces'));
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function approve(Booking $booking)
    {
        $booking->update([
            'status' => 'confirmed',
            'payment_status' => 'paid',
        ]);

        return redirect()->back()->with('success', 'Booking approved successfully.');
    }

    public function cancel(Booking $booking)
    {
        $booking->update([
            'status' => 'cancelled',
        ]);

        return redirect()->back()->with('success', 'Booking cancelled successfully.');
    }
}
