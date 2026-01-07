@extends('layouts.admin')

@section('content')
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('admin.bookings.index') }}"
            class="p-2 bg-white rounded-lg border border-gray-200 text-gray-500 hover:text-gray-900 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Booking Details</h1>
            <p class="text-gray-500">ID: #{{ substr($booking->id, -8) }}</p>
        </div>
        <div class="ml-auto flex gap-3">
            @if($booking->status == 'pending')
                <form action="{{ route('admin.bookings.approve', $booking) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" onclick="return confirm('Are you sure you want to approve this booking?')"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-bold shadow-sm transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Approve / Mark Paid
                    </button>
                </form>
                <form action="{{ route('admin.bookings.cancel', $booking) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" onclick="return confirm('Are you sure you want to cancel this booking?')"
                        class="bg-white border border-red-200 text-red-600 hover:bg-red-50 px-4 py-2 rounded-lg font-bold shadow-sm transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                        Cancel
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Guest Info -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Guest Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-bold mb-1">Full Name</p>
                        <p class="font-medium text-gray-900 text-lg">{{ $booking->guest_name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-bold mb-1">Company / Organization</p>
                        <p class="font-medium text-gray-900 text-lg">{{ $booking->company_name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-bold mb-1">Email Address</p>
                        <p class="font-medium text-gray-900">{{ $booking->guest_email }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-bold mb-1">WhatsApp Number</p>
                        <div class="flex items-center gap-2">
                            <p class="font-medium text-gray-900">{{ $booking->guest_whatsapp }}</p>
                            <a href="https://wa.me/{{ $booking->guest_whatsapp }}" target="_blank"
                                class="bg-green-500 hover:bg-green-600 text-white text-xs px-2 py-1 rounded flex items-center gap-1 transition">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.6 1.672-.995 3.276-1.591 5.392l-1.654-6.305 6.305 1.654zm-2.062-6.52c-.413-.086-.713-.128-.985-.128-.27 0-.57.065-.853.195-.285.13-.574.285-.806.452-.23.167-.425.374-.53.53l.53.53c.105.156.326.363.53.53.204.167.452.322.693.452.24.13.525.26.853.26.272 0 .572-.042.985-.128.413-.086.713-.128.985-.128.27 0 .57.065.853.195.285.13.574.285.806.452.23.167.425.374.53.53l.53.53c.105.156.326.363.53.53.204.167.452.322.693.452.24.13.525.26.853.26.272 0 .572-.042.985-.128.413-.086.713-.128.985-.128z" />
                                </svg>
                                Chat
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Details -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Booking & Space</h3>
                <div class="flex items-start gap-4 mb-6">
                    <img src="{{ Str::startsWith($booking->space->image, 'http') ? $booking->space->image : asset('storage/' . $booking->space->image) }}"
                        alt="{{ $booking->space->name }}" class="w-24 h-24 rounded-lg object-cover shadow-sm">
                    <div>
                        <h4 class="text-xl font-bold text-gray-900">{{ $booking->space->name }}</h4>
                        <p class="text-gray-500">{{ $booking->space->location }}</p>
                        <span
                            class="inline-block mt-2 px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold uppercase">{{ str_replace('_', ' ', $booking->space->type) }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 bg-gray-50 p-4 rounded-xl">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-bold mb-1">Date</p>
                        <p class="font-bold text-gray-800">{{ $booking->booking_date }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-bold mb-1">Time</p>
                        <p class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}
                            - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-bold mb-1">Duration</p>
                        <p class="font-bold text-gray-800">{{ $booking->duration }}
                            {{ Str::plural($booking->duration_unit, $booking->duration) }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-bold mb-1">Total Guests</p>
                        <p class="font-bold text-gray-800">{{ $booking->total_guests }} People</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar / Status -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-sm font-bold text-gray-500 uppercase mb-4">Status</h3>

                <div class="flex flex-col gap-4">
                    <div>
                        <label class="text-xs text-gray-400 mb-1 block">Booking Status</label>
                        @if($booking->status == 'confirmed')
                            <span
                                class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-bold">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span> Confirmed
                            </span>
                        @elseif($booking->status == 'pending')
                            <span
                                class="inline-flex items-center gap-2 px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-bold">
                                <span class="w-2 h-2 rounded-full bg-yellow-500"></span> Pending
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-2 px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-bold">
                                <span class="w-2 h-2 rounded-full bg-red-500"></span> Cancelled
                            </span>
                        @endif
                    </div>

                    <div>
                        <label class="text-xs text-gray-400 mb-1 block">Payment Status</label>
                        @if($booking->payment_status == 'paid')
                            <span
                                class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-bold">Paid</span>
                        @else
                            <span
                                class="inline-flex items-center gap-2 px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-bold">Unpaid</span>
                        @endif
                    </div>
                </div>

                <div class="border-t border-gray-100 mt-6 pt-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-600">Total Price</span>
                        <span class="text-xl font-bold text-brand-dark">IDR
                            {{ number_format($booking->total_price) }}</span>
                    </div>
                </div>
            </div>
            <!-- Quick Note: Payment Proof if uploaded could go here -->
        </div>
    </div>
@endsection