@extends('layouts.admin')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Bookings</h1>
        <p class="text-gray-500">View and manage all booking requests.</p>
    </div>

    <!-- Filters -->
    <form method="GET" action="{{ route('admin.bookings.index') }}" class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-6 flex gap-4">
        <div class="relative flex-1">
            <svg class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input type="text" name="search" placeholder="Search by guest name or booking ID..."
                value="{{ request('search') }}"
                class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-brand focus:border-brand">
        </div>
        <div class="relative">
            <select name="status" onchange="this.form.submit()"
                class="appearance-none bg-none border border-gray-200 rounded-lg pl-4 pr-10 py-2 focus:ring-brand focus:border-brand text-gray-600 bg-white cursor-pointer">
                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Statuses</option>
                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </div>
        <div class="relative">
            <select name="space_id" onchange="this.form.submit()"
                class="appearance-none bg-none border border-gray-200 rounded-lg pl-4 pr-10 py-2 focus:ring-brand focus:border-brand text-gray-600 bg-white cursor-pointer">
                <option value="">All Rooms</option>
                @foreach($spaces as $space)
                    <option value="{{ $space->id }}" {{ request('space_id') == $space->id ? 'selected' : '' }}>{{ $space->name }}</option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </div>
    </form>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Booking ID</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Guest</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Space</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Date & Time</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($bookings as $booking)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs text-gray-500">
                            #{{ substr($booking->id, -8) }}
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-gray-800">{{ $booking->guest_name }}</p>
                            <p class="text-xs text-gray-400">{{ $booking->company_name ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $booking->space->name }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}<br>
                            <span
                                class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}</span>
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-800">
                            IDR {{ number_format((float) $booking->total_price) }}
                        </td>
                        <td class="px-6 py-4">
                            @if($booking->status == 'confirmed')
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">Confirmed</span>
                            @elseif($booking->status == 'pending')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">Pending</span>
                            @else
                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">Cancelled</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                class="text-brand hover:text-brand-dark font-medium text-sm">View Details</a>
                        </td>
                    </tr>
                @endforeach

                @if($bookings->count() == 0)
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                            No bookings found.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection