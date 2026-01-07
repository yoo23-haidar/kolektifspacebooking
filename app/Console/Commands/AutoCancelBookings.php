<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AutoCancelBookings extends Command
{
    protected $signature = 'bookings:autocancel';
    protected $description = 'Cancel pending bookings older than 3 hours';

    public function handle()
    {
        $cutoff = now()->subHours(3);

        $count = \App\Models\Booking::where('status', 'pending')
            ->where('created_at', '<=', $cutoff)
            ->update(['status' => 'cancelled']);

        if ($count > 0) {
            $this->info("Cancelled $count expired booking(s).");
        } else {
            $this->info("No expired bookings found.");
        }
    }
}
