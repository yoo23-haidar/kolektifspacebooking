<?php

namespace Database\Seeders;

use App\Models\Space;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // meeting_ammenities
        $meetingAmenities = ['Free Wifi', 'Smart TV', 'AC', 'Table & Chairs', 'Free Parking'];
        $officeAmenities = [
            'Strategic Address',
            '1 Set of Desk & Chair',
            'Free Wifi & AC',
            'Genset & 24-Hour Security',
            'Receptionist',
            'Free Parking',
            '12 Hours Meeting Room Access',
            '10% FnB Discount'
        ];

        $spaces = [
            // --- Meeting Rooms ---
            [
                'name' => 'Mini Room',
                'type' => 'meeting_room',
                'capacity' => 4,
                'location' => 'Yogyakarta',
                'sub_location' => 'Central & North',
                'price_hourly' => 25000,
                'price_3_hours' => 50000,
                'price_6_hours' => 80000,
                'price_daily' => 120000,
                'description' => 'Most privacy efficient. Ideal for interviews, private calls, and 1-on-1s.',
                'amenities' => $meetingAmenities,
                'image' => 'https://images.unsplash.com/photo-1517502884422-41e170d8a165?auto=format&fit=crop&w=1950&q=80',
            ],
            [
                'name' => 'Small Room',
                'type' => 'meeting_room',
                'capacity' => 10,
                'location' => 'Yogyakarta',
                'sub_location' => 'Central & North',
                'price_hourly' => 50000,
                'price_3_hours' => 100000,
                'price_6_hours' => 180000,
                'price_daily' => 350000,
                'description' => 'Standard meeting size. Perfect for client pitches, board meetings, and team syncs.',
                'amenities' => $meetingAmenities,
                'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1950&q=80',
            ],
            [
                'name' => 'Medium Room',
                'type' => 'meeting_room',
                'capacity' => 20,
                'location' => 'Yogyakarta',
                'sub_location' => 'Central & North',
                'price_hourly' => 80000,
                'price_3_hours' => 200000,
                'price_6_hours' => 380000,
                'price_daily' => 580000,
                'description' => 'Flexible layout. Ideal for workshops, training sessions, and larger focus groups.',
                'amenities' => array_merge($meetingAmenities, ['Layout by Request', 'Whiteboard', 'Projector']),
                'image' => 'https://images.unsplash.com/photo-1517502884422-41e170d8a165?auto=format&fit=crop&w=1950&q=80',
            ],
            [
                'name' => 'Large Room',
                'type' => 'meeting_room',
                'capacity' => 100,
                'location' => 'Yogyakarta',
                'sub_location' => 'Central & North',
                'price_hourly' => 120000,
                'price_3_hours' => 300000,
                'price_6_hours' => 580000,
                'price_daily' => 900000,
                'description' => 'Flagship venue. Unbeatable value for seminars, town halls, and community events.',
                'amenities' => array_merge($meetingAmenities, ['Layout by Request', 'Sound System', 'Projector', 'Microphones']),
                'image' => 'https://images.unsplash.com/photo-1431540015161-0bf868a2d407?auto=format&fit=crop&w=1950&q=80',
            ],

            // --- Office Spaces (Mini Series) ---
            [
                'name' => 'Mini Satiti',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'North',
                'capacity' => 2,
                'dimensions' => '3m x 2m (6 m2)',
                'price_daily' => 120000,
                'price_weekly' => 600000,
                'price_monthly' => 1500000,
                'amenities' => $officeAmenities,
            ],
            [
                'name' => 'Mini Wisis',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'North',
                'capacity' => 2,
                'dimensions' => '3m x 2m (6 m2)',
                'price_daily' => 120000,
                'price_weekly' => 600000,
                'price_monthly' => 1500000,
                'amenities' => $officeAmenities,
            ],
            [
                'name' => 'Mini Loma',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'North',
                'capacity' => 2,
                'dimensions' => '3m x 2m (6 m2)',
                'price_daily' => 120000,
                'price_weekly' => 600000,
                'price_monthly' => 1500000,
                'amenities' => $officeAmenities,
            ],
            [
                'name' => 'Mini Expert',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'Central & North',
                'capacity' => 2,
                'dimensions' => '1.8m x 3.1m (5.58 m2)',
                'price_daily' => 120000,
                'price_weekly' => 480000,
                'price_monthly' => 1500000,
                'amenities' => $officeAmenities,
            ],
            [
                'name' => 'Mini Noble',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'Central & North',
                'capacity' => 3,
                'dimensions' => '3.4m x 2.7m (9.18 m2)',
                'price_daily' => 120000,
                'price_weekly' => 480000,
                'price_monthly' => 1500000,
                'description' => 'Best Value Mini Office. 50% larger than standard pods.',
                'amenities' => $officeAmenities,
            ],

            // --- Office Spaces (Small Series) ---
            [
                'name' => 'Small Patient',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'Central & North',
                'capacity' => 4,
                'dimensions' => '3.1m x 3.2m (9.92 m2)',
                'price_daily' => 350000,
                'price_weekly' => 750000,
                'price_monthly' => 2700000,
                'description' => 'Most affordable entry point for Small Offices.',
                'amenities' => $officeAmenities,
            ],
            [
                'name' => 'Small Wise',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'Central & North',
                'capacity' => 5,
                'dimensions' => '3.1m x 4m (12.4 m2)',
                'price_daily' => 350000,
                'price_weekly' => 950000,
                'price_monthly' => 3400000,
                'amenities' => $officeAmenities,
            ],
            [
                'name' => 'Small Hope',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'Central & North',
                'capacity' => 4,
                'dimensions' => '3.1m x 3.2m (9.92 m2)',
                'price_daily' => 350000,
                'price_weekly' => 1000000,
                'price_monthly' => 3700000,
                'amenities' => $officeAmenities,
            ],
            [
                'name' => 'Small Sumanak',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'North',
                'capacity' => 4,
                'dimensions' => '3m x 4.5m (13.5 m2)',
                'price_daily' => 350000,
                'price_weekly' => 1110000,
                'price_monthly' => 3800000,
                'amenities' => $officeAmenities,
            ],
            [
                'name' => 'Small Taberi',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'North',
                'capacity' => 4,
                'dimensions' => '3m x 4.5m (13.5 m2)',
                'price_daily' => 350000,
                'price_weekly' => 1200000,
                'price_monthly' => 3800000,
                'amenities' => $officeAmenities,
            ],
            [
                'name' => 'Small Splendid',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'Central',
                'capacity' => 5,
                'dimensions' => '6m x 2.8m (16.8 m2)',
                'price_daily' => 350000,
                'price_weekly' => 1400000,
                'price_monthly' => 4700000,
                'amenities' => $officeAmenities,
            ],
            [
                'name' => 'Small Believe',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'Central',
                'capacity' => 6,
                'dimensions' => '4m x 4.5m (18 m2)',
                'price_daily' => 380000,
                'price_weekly' => 2320000,
                'price_monthly' => 5000000,
                'amenities' => $officeAmenities,
            ],
            [
                'name' => 'Small Positive',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'Central',
                'capacity' => 5,
                'dimensions' => '5.3m x 3.1m (16.43 m2)',
                'price_daily' => 350000,
                'price_weekly' => 1400000,
                'price_monthly' => 5500000,
                'amenities' => $officeAmenities,
            ],
            [
                'name' => 'Small Smart',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'Central',
                'capacity' => 6,
                'dimensions' => '5m x 4m (20 m2)',
                'price_daily' => 350000,
                'price_weekly' => 1500000,
                'price_monthly' => 5500000,
                'amenities' => $officeAmenities,
            ],
            [
                'name' => 'Small Share',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'Central',
                'capacity' => 5,
                'dimensions' => '5.3m x 3.1m (16.43 m2)',
                'price_daily' => 350000,
                'price_weekly' => 1500000,
                'price_monthly' => 5500000,
                'amenities' => $officeAmenities,
            ],
            [
                'name' => 'Small Dignity',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'Central',
                'capacity' => 6,
                'dimensions' => '4.5m x 4.5m (20.25 m2)',
                'price_daily' => 350000,
                'price_weekly' => 1520000,
                'price_monthly' => 5700000,
                'amenities' => $officeAmenities,
            ],
            [
                'name' => 'Small Trust',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'Central',
                'capacity' => 6,
                'dimensions' => '4m x 5.3m (21.2 m2)',
                'price_daily' => 350000,
                'price_weekly' => 1590000,
                'price_monthly' => 5800000,
                'amenities' => $officeAmenities,
            ],

            // --- Office Spaces (Large Series) ---
            [
                'name' => 'Large Encourage',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'Central',
                'capacity' => 10,
                'dimensions' => '5.3m x 3.1m (16.43 m2)',
                'price_daily' => 900000,
                'price_weekly' => 4400000,
                'price_monthly' => 16500000,
                'amenities' => $officeAmenities,
            ],
            [
                'name' => 'Large Prasaja',
                'type' => 'office_space',
                'location' => 'Yogyakarta',
                'sub_location' => 'Central',
                'capacity' => 20,
                'dimensions' => '8.2m x 9m (81.8 m2)',
                'price_daily' => 900000,
                'price_weekly' => 6135000,
                'price_monthly' => 22500000,
                'description' => 'Flagship Room. Huge capacity.',
                'amenities' => $officeAmenities,
            ],

            // --- Hot Desks (Removed) ---

            // --- Hot Desks (Removed) ---

            // --- Event Spaces (Removed) ---
        ];

        // Cleanup removed space types
        Space::where('type', 'event_space')->delete();

        foreach ($spaces as $data) {
            $data['slug'] = Str::slug($data['name']);

            // Enforce standard images by type
            if ($data['type'] === 'meeting_room') {
                $data['image'] = 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1950&q=80';
            } elseif ($data['type'] === 'office_space') {
                $data['image'] = 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&w=1950&q=80';
            }

            if (!isset($data['location'])) {
                $data['location'] = 'Yogyakarta';
            }

            Space::updateOrCreate(
                ['slug' => $data['slug']], // Check duplicate by slug
                $data
            );
        }
    }
}
