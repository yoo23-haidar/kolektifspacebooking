<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Space;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing bookings for fresh demo data
        Booking::truncate();

        $spaces = Space::all();

        // Demo guest data with Indonesian-style names and companies
        $guests = [
            ['name' => 'Andi Pratama', 'company' => 'PT Teknologi Nusantara', 'email' => 'andi@teknusa.co.id', 'whatsapp' => '081234567890'],
            ['name' => 'Siti Rahayu', 'company' => 'CV Kreasi Digital', 'email' => 'siti@kreasidigital.id', 'whatsapp' => '082345678901'],
            ['name' => 'Budi Santoso', 'company' => 'PT Maju Bersama', 'email' => 'budi@majubersama.com', 'whatsapp' => '083456789012'],
            ['name' => 'Dewi Kartika', 'company' => 'Startup Jogja', 'email' => 'dewi@startupjogja.id', 'whatsapp' => '084567890123'],
            ['name' => 'Rizky Hidayat', 'company' => 'PT Solusi Kreatif', 'email' => 'rizky@solusikreatif.co.id', 'whatsapp' => '085678901234'],
            ['name' => 'Maya Putri', 'company' => 'Digital Agency ID', 'email' => 'maya@digitalagency.id', 'whatsapp' => '086789012345'],
            ['name' => 'Fajar Nugroho', 'company' => 'PT Inovasi Mandiri', 'email' => 'fajar@inovasimandiri.com', 'whatsapp' => '087890123456'],
            ['name' => 'Ratna Sari', 'company' => 'Komunitas UMKM Jogja', 'email' => 'ratna@umkmjogja.org', 'whatsapp' => '088901234567'],
        ];

        $today = Carbon::today();

        // Create sample bookings
        $bookings = [
            // Today's bookings (for dashboard testing)
            [
                'guest_index' => 0,
                'space_name' => 'Small Room',
                'booking_date' => $today,
                'start_time' => '10:00',
                'duration' => 2,
                'duration_unit' => 'hour',
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'total_guests' => 4,
            ],
            [
                'guest_index' => 1,
                'space_name' => 'Mini Room',
                'booking_date' => $today,
                'start_time' => '14:00',
                'duration' => 3,
                'duration_unit' => 'hour',
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'total_guests' => 2,
            ],
            [
                'guest_index' => 2,
                'space_name' => 'Medium Room',
                'booking_date' => $today,
                'start_time' => '15:00',
                'duration' => 1,
                'duration_unit' => 'hour',
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'total_guests' => 8,
            ],

            // Tomorrow's bookings
            [
                'guest_index' => 3,
                'space_name' => 'Large Room',
                'booking_date' => $today->copy()->addDay(),
                'start_time' => '09:00',
                'duration' => 1,
                'duration_unit' => 'day',
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'total_guests' => 50,
            ],
            [
                'guest_index' => 4,
                'space_name' => 'Small Room',
                'booking_date' => $today->copy()->addDay(),
                'start_time' => '13:00',
                'duration' => 2,
                'duration_unit' => 'hour',
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'total_guests' => 6,
            ],

            // Past bookings (for history)
            [
                'guest_index' => 5,
                'space_name' => 'Mini Room',
                'booking_date' => $today->copy()->subDays(2),
                'start_time' => '10:00',
                'duration' => 1,
                'duration_unit' => 'hour',
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'total_guests' => 2,
            ],
            [
                'guest_index' => 6,
                'space_name' => 'Small Splendid',
                'booking_date' => $today->copy()->subDays(3),
                'start_time' => '09:00',
                'duration' => 1,
                'duration_unit' => 'day',
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'total_guests' => 4,
            ],
            [
                'guest_index' => 7,
                'space_name' => 'Large Room',
                'booking_date' => $today->copy()->subDays(5),
                'start_time' => '09:00',
                'duration' => 6,
                'duration_unit' => 'hour',
                'status' => 'cancelled',
                'payment_status' => 'unpaid',
                'total_guests' => 30,
            ],
        ];

        foreach ($bookings as $data) {
            $guest = $guests[$data['guest_index']];
            $space = $spaces->firstWhere('name', $data['space_name']);

            if (!$space)
                continue;

            // Calculate price based on duration_unit
            $price = match ($data['duration_unit']) {
                'hour' => ($space->price_hourly ?? 0) * $data['duration'],
                'day' => ($space->price_daily ?? 0) * $data['duration'],
                'week' => ($space->price_weekly ?? 0) * $data['duration'],
                'month' => ($space->price_monthly ?? 0) * $data['duration'],
                default => 0,
            };

            // Calculate end time
            $startTime = Carbon::parse($data['start_time']);
            $endTime = match ($data['duration_unit']) {
                'hour' => $startTime->copy()->addHours($data['duration']),
                'day' => $startTime->copy()->addHours(12),
                'week' => $startTime->copy()->addDays(7),
                'month' => $startTime->copy()->addMonth(),
                default => $startTime->copy()->addHours($data['duration']),
            };

            Booking::create([
                'space_id' => $space->id,
                'guest_name' => $guest['name'],
                'company_name' => $guest['company'],
                'guest_email' => $guest['email'],
                'guest_whatsapp' => $guest['whatsapp'],
                'booking_date' => $data['booking_date'],
                'start_time' => $startTime,
                'end_time' => $endTime,
                'duration' => $data['duration'],
                'duration_unit' => $data['duration_unit'],
                'total_price' => $price,
                'total_guests' => $data['total_guests'],
                'status' => $data['status'],
                'payment_status' => $data['payment_status'],
            ]);
        }
    }
}
