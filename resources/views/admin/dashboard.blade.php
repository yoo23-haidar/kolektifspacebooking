@extends('layouts.admin')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-500">Welcome back, {{ Auth::user()->name }}! Here's what's happening today.</p>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Revenue -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <span class="text-gray-400 text-sm font-medium uppercase tracking-wider">Today's Revenue</span>
                <span class="p-2 bg-green-50 text-green-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </span>
            </div>
            <div class="flex items-baseline">
                <span class="text-3xl font-bold text-gray-800">IDR {{ number_format($todayRevenue) }}</span>
                {{-- <span class="ml-2 text-sm text-green-500 font-medium">+0%</span> --}}
            </div>
        </div>

        <!-- Occupancy -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <span class="text-gray-400 text-sm font-medium uppercase tracking-wider">Occupancy</span>
                <span class="p-2 bg-brand-light/10 text-brand rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                </span>
            </div>
            <div class="flex items-baseline">
                <span class="text-3xl font-bold text-gray-800">{{ $occupancyRate }}%</span>
                <span class="ml-2 text-sm text-gray-500">Live Occupancy</span>
            </div>
        </div>

        <!-- Pending Check-ins (Guests Expected) -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <span class="text-gray-400 text-sm font-medium uppercase tracking-wider">Total Guests</span>
                <span class="p-2 bg-orange-50 text-orange-500 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </span>
            </div>
            <div class="flex items-baseline">
                <span class="text-3xl font-bold text-gray-800">{{ $guestsExpected }}</span>
                <span class="ml-2 text-sm text-gray-500">Guests Expected Today</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Happening Now -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-lg font-bold text-gray-800">Happening Now</h2>
                <span class="text-xs bg-green-100 text-green-700 font-bold px-2 py-1 rounded-full uppercase tracking-wide">Live</span>
            </div>
            <div class="p-6">
                @if($activeBookings->count() > 0)
                    <div class="space-y-4">
                        @foreach($activeBookings as $booking)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                                <div class="flex items-center gap-4">
                                     <!-- Space Initials or Icon -->
                                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                                        {{ substr($booking->space->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800">{{ $booking->space->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $booking->guest_name }} ({{ $booking->company_name ?? 'Personal' }})</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="block text-xs font-bold text-gray-800">Ends at {{ $booking->end_time->format('H:i') }}</span>
                                    <span class="text-xs text-green-600">In Progress</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State Placeholder -->
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">All quiet on the floor.</p>
                        <p class="text-gray-400 text-sm mt-1">No active meeting room bookings right now.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Incoming Requests -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-lg font-bold text-gray-800">Incoming Requests</h2>
                <a href="{{ route('admin.bookings.index') }}" class="text-sm text-brand hover:underline">View All</a>
            </div>
            <div class="p-6">
                @if($incomingRequests->count() > 0)
                    <div class="space-y-4">
                        @foreach($incomingRequests as $booking)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-brand-light/10 text-brand flex items-center justify-center font-bold">
                                        {{ substr($booking->guest_name, 0, 2) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800">{{ $booking->guest_name }}</p>
                                        <p class="text-xs text-gray-500">{{ $booking->space->name }} • {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d') }}, {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}</p>
                                    </div>
                                </div>
                                <div>
                                    @if($booking->payment_status == 'paid')
                                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Paid</span>
                                    @else
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">Pending Payment</span>
                                    @endif
                                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="ml-2 text-xs text-gray-400 hover:text-gray-600">View</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500 text-sm">
                        No pending requests.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection