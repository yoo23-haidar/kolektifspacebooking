<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Breadcrumbs -->
        <nav class="flex text-sm text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-brand">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('explore') }}?type={{ $space->type }}" class="hover:text-brand">{{ ucwords(str_replace('_', ' ', $space->type)) }}s</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900 font-medium">{{ $space->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Left Column: Content -->
            <div class="lg:col-span-2 space-y-8">

                <!-- Gallery (Desktop Grid / Mobile Swipe) -->
                <div class="relative rounded-2xl overflow-hidden h-64 md:h-96 shadow-lg bg-gray-100 group">
                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                        alt="Space" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition"></div>
                    <button
                        class="absolute bottom-4 right-4 bg-white/90 backdrop-blur px-4 py-2 rounded-lg text-sm font-bold shadow-md hover:bg-white transition">
                        View All Photos
                    </button>
                </div>

                <!-- Title & Header -->
                <div>
                    <div class="flex justify-between items-start">
                        <!-- Left Side: Title & Location -->
                        <div>
                            <!-- Space Type Kicker -->
                            <div class="text-sm font-bold text-brand uppercase tracking-wider mb-2">
                                {{ ucwords(str_replace('_', ' ', $space->type)) }}
                            </div>

                            <!-- Main Title -->
                            <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                                {{ $space->name }}
                            </h1>

                            <!-- Location -->
                            <div class="flex items-center gap-2 text-gray-500 font-medium text-lg">
                                <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $space->location }}
                                    {{ $space->sub_location ? '• ' . $space->sub_location : '' }}</span>
                            </div>
                        </div>

                        <!-- Right Side: Rating (Desktop) -->
                        <!-- Right Side: Rating (Removed) -->
                    </div>

                    <!-- Status Tags -->
                    <div class="flex items-center gap-4 mt-6 mb-10">
                        <div
                            class="flex items-center gap-2 text-sm text-green-700 font-bold bg-green-50 px-3 py-1.5 rounded-full border border-green-100">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span> Available Now
                        </div>
                        <!-- Mobile Rating (Visible only on small screens) -->
                        <!-- Mobile Rating (Removed) -->
                    </div>

                    <!-- Amenities List -->
                    <div class="mb-10">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Amenities</h2>
                        <div class="grid grid-cols-2 gap-4">
                            @if($space->amenities)
                                @foreach($space->amenities as $amenity)
                                    <div class="flex items-center gap-2 text-gray-600">
                                        <svg class="w-5 h-5 text-brand-light" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ $amenity }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-10 prose prose-green">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">About this space</h2>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $space->description ?? 'Experience premium workspace designed for productivity and comfort. Included access to community events and shared amenities.' }}
                        </p>
                        @if($space->dimensions)
                            <div class="mt-6 space-y-2">
                                <p class="font-bold text-brand flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4">
                                        </path>
                                    </svg>
                                    Dimensions: {{ $space->dimensions }}
                                </p>
                            </div>
                        @endif

                        @if($space->capacity)
                            <div class="mt-2 text-brand font-bold flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                Max Capacity: {{ $space->capacity }} People
                            </div>
                        @endif
                    </div>

                    <!-- Community Manager (Removed) -->
                </div>

                <!-- Right Column: Booking Card (Sticky Desktop) -->
                <div class="hidden lg:block" x-data="bookingCalculator({
                            spaceId: '{{ $space->id }}',
                            type: '{{ $space->type }}',
                            priceHourly: {{ $space->price_hourly ?? 0 }},
                            price3Hours: {{ $space->price_3_hours ?? 0 }},
                            price6Hours: {{ $space->price_6_hours ?? 0 }},
                            priceDaily: {{ $space->price_daily ?? 0 }},
                            priceWeekly: {{ $space->price_weekly ?? 0 }},
                            priceMonthly: {{ $space->price_monthly ?? 0 }}
                         })">
                    <div class="sticky top-24 bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
                        <div class="flex justify-between items-end mb-6">
                            <div>
                                <span class="text-3xl font-bold text-gray-900" x-text="'IDR ' + formattedPrice"></span>
                                <span class="text-gray-500" x-text="'/' + pricingLabel"></span>
                            </div>
                            <div class="text-xs text-green-600 font-bold bg-green-50 px-2 py-1 rounded">Available
                                Now</div>
                        </div>

                        <form action="{{ route('booking.store') }}" method="POST" class="space-y-4"
                            @submit.prevent="submitBooking($event)">
                            @csrf
                            <input type="hidden" name="space_id" value="{{ $space->id }}">
                            <input type="hidden" name="pricing_type" x-model="pricingType">
                            <input type="hidden" name="end_time" x-model="endTime">

                            <!-- Pricing Tabs -->
                            <div class="flex bg-gray-100 p-1 rounded-lg overflow-x-auto">
                                <template x-if="type == 'meeting_room'">
                                    <div class="flex space-x-1 w-full min-w-max">
                                        <button type="button" @click="setPricing('hourly')"
                                            :class="{'bg-white shadow text-gray-900': pricingType == 'hourly', 'text-gray-500': pricingType != 'hourly'}"
                                            class="flex-1 px-3 py-1.5 rounded-md text-xs font-bold transition whitespace-nowrap">Hourly</button>
                                        <button type="button" @click="setPricing('3_hours')"
                                            :class="{'bg-white shadow text-gray-900': pricingType == '3_hours', 'text-gray-500': pricingType != '3_hours'}"
                                            class="flex-1 px-3 py-1.5 rounded-md text-xs font-bold transition whitespace-nowrap">3
                                            Hours</button>
                                        <button type="button" @click="setPricing('6_hours')"
                                            :class="{'bg-white shadow text-gray-900': pricingType == '6_hours', 'text-gray-500': pricingType != '6_hours'}"
                                            class="flex-1 px-3 py-1.5 rounded-md text-xs font-bold transition whitespace-nowrap">6
                                            Hours</button>
                                        <button type="button" @click="setPricing('daily')"
                                            :class="{'bg-white shadow text-gray-900': pricingType == 'daily', 'text-gray-500': pricingType != 'daily'}"
                                            class="flex-1 px-3 py-1.5 rounded-md text-xs font-bold transition whitespace-nowrap">Daily</button>
                                    </div>
                                </template>
                                <template x-if="type == 'office_space'">
                                    <div class="flex space-x-1 w-full">
                                        <button type="button" @click="setPricing('daily')"
                                            :class="{'bg-white shadow text-gray-900': pricingType == 'daily', 'text-gray-500': pricingType != 'daily'}"
                                            class="flex-1 px-3 py-1.5 rounded-md text-xs font-bold transition">Daily</button>
                                        <button type="button" @click="setPricing('weekly')"
                                            :class="{'bg-white shadow text-gray-900': pricingType == 'weekly', 'text-gray-500': pricingType != 'weekly'}"
                                            class="flex-1 px-3 py-1.5 rounded-md text-xs font-bold transition">Weekly</button>
                                        <button type="button" @click="setPricing('monthly')"
                                            :class="{'bg-white shadow text-gray-900': pricingType == 'monthly', 'text-gray-500': pricingType != 'monthly'}"
                                            class="flex-1 px-3 py-1.5 rounded-md text-xs font-bold transition">Monthly</button>
                                    </div>
                                </template>
                            </div>

                            <!-- Date & Time -->
                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Date</label>
                                    <input type="text" name="booking_date" x-ref="datePicker" required
                                        placeholder="Select Date"
                                        class="w-full rounded-lg border-gray-300 focus:border-brand focus:ring-brand font-bold text-brand-dark bg-white">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Start
                                            Time</label>
                                        <select name="start_time" x-model="startTime" required @change="calculateTotal"
                                            class="w-full rounded-lg border-gray-300 focus:border-brand focus:ring-brand font-bold text-brand-dark">
                                            <option value="" disabled>Select Time</option>
                                            @foreach(range(9, 21) as $hour)
                                                <option value="{{ sprintf('%02d:00', $hour) }}">
                                                    {{ sprintf('%02d:00', $hour) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Duration
                                            <span x-text="'(' + durationUnitLabel + ')'"
                                                class="lowercase font-normal"></span></label>
                                        <input type="number" name="duration" x-model="duration" min="1" required
                                            class="w-full rounded-lg border-gray-300 focus:border-brand focus:ring-brand font-bold text-brand-dark">
                                    </div>
                                </div>
                            </div>

                            <hr class="border-gray-100">

                            <!-- Guest Details (No Auth) -->
                            <div>
                                <h3 class="font-bold text-gray-900 mb-3">Your Details</h3>
                                <div class="space-y-3">
                                    <input type="text" name="guest_name" placeholder="Full Name" required
                                        class="w-full rounded-lg border-gray-300 focus:border-brand focus:ring-brand text-sm">
                                    <input type="text" name="company_name" placeholder="Institute / Agency / Company"
                                        required
                                        class="w-full rounded-lg border-gray-300 focus:border-brand focus:ring-brand text-sm">
                                    <div class="grid grid-cols-2 gap-3">
                                        <input type="email" name="guest_email" placeholder="Email Address" required
                                            class="w-full rounded-lg border-gray-300 focus:border-brand focus:ring-brand text-sm">
                                        <input type="text" name="guest_whatsapp" placeholder="WhatsApp (e.g., 0812...)"
                                            required pattern="[0-9]{10,14}"
                                            class="w-full rounded-lg border-gray-300 focus:border-brand focus:ring-brand text-sm">
                                    </div>
                                    <input type="number" name="total_guests" placeholder="Number of People" required
                                        min="1" max="{{ $space->capacity }}"
                                        class="w-full rounded-lg border-gray-300 focus:border-brand focus:ring-brand text-sm">
                                </div>
                            </div>

                            <!-- Summary -->
                            <div class="pt-4 space-y-2 border-t border-gray-100 mt-4">
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span x-text="summaryLabel"></span>
                                    <span x-text="'IDR ' + (subtotal).toLocaleString('id-ID')"></span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Service Fee</span>
                                    <span>IDR 0</span>
                                </div>
                                <div class="border-t pt-2 flex justify-between font-bold text-brand-dark text-lg">
                                    <span>Total</span>
                                    <span x-text="'IDR ' + (total).toLocaleString('id-ID')"></span>
                                </div>
                            </div>

                            <!-- Messages -->
                            <div x-show="errorMessage" x-text="errorMessage" class="text-red-500 text-sm text-center">
                            </div>

                            <button type="submit" :disabled="loading"
                                class="w-full bg-brand hover:bg-brand-dark disabled:bg-gray-300 disabled:cursor-not-allowed text-white font-bold py-3 rounded-xl transition shadow-lg flex items-center justify-center gap-2">
                                <span x-show="loading"
                                    class="animate-spin rounded-full h-4 w-4 border-b-2 border-white"></span>
                                <span x-text="loading ? 'Checking...' : 'Request to Book'"></span>
                            </button>
                            <p class="text-center text-xs text-gray-400 mt-2">No account required.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Sticky Footer CTA -->
        <div class="fixed bottom-16 left-0 right-0 bg-white border-t border-gray-100 p-4 lg:hidden z-40 pb-safe-offset shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]"
            x-data="{ open: false }">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-lg font-bold text-gray-900">
                        @if($space->price_daily)
                            IDR {{ number_format($space->price_daily / 1000) }}k
                        @elseif($space->price_weekly)
                            IDR {{ number_format($space->price_weekly / 1000) }}k
                        @else
                            Ask
                        @endif
                    </p>
                    <p class="text-xs text-gray-500">
                        @if($space->price_daily) /day @elseif($space->price_weekly) /week @endif
                    </p>
                </div>
                <!-- Use anchor to anchor to top form if simple, or duplicate component logic -->
                <!-- For MVP, scroll to top or simple link to standard form page if needed. 
                          Ideally this opens a modal. Let's redirect to 'desktop' view logic or scroll up.
                          Or just link to a separate booking page `booking/create?space_id=...` which we haven't built. 
                          Let's just scroll to top for now as the form is visible on mobile? No it's hidden lg:block above.
                          We need the form on mobile too. -->
                <button @click="open = true"
                    class="bg-brand text-white font-bold px-8 py-3 rounded-xl shadow-lg flex-1">
                    Book Now
                </button>
            </div>

            <!-- Mobile Booking Modal -->
            <div x-show="open"
                class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-end sm:items-center justify-center p-4">
                <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-2xl relative" @click.away="open = false">
                    <button @click="open = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <h3 class="text-xl font-bold mb-4">Book {{ $space->name }}</h3>
                    <!-- Re-use the calculator logic here... technically should be a reusable blade component. 
                             For quick implementation, I'll instruct user to use Desktop for best experience or duplicate logic.
                             Actually, let's just create a simplified version or say 'Please visit on desktop' if complex?
                             No, 'Mobile First' is the goal.
                             We should extract the form into a component. 
                             But for this 'replace_file' pass, I'll just render a simple text redirecting or duplicate the x-data logic if possible.
                             However, x-data scopes are separate.
                             
                             Better approach: The "Hidden lg:block" div above contains the form. 
                             Let's REMOVE "hidden lg:block class" and instead layout it differently? 
                             Or Copy-Paste the code. I will copy-paste the x-data for mobile modal.
                        -->
                    <div x-data="bookingCalculator({
                            spaceId: '{{ $space->id }}',
                            type: '{{ $space->type }}',
                            priceHourly: {{ $space->price_hourly ?? 0 }},
                            price3Hours: {{ $space->price_3_hours ?? 0 }},
                            price6Hours: {{ $space->price_6_hours ?? 0 }},
                            priceDaily: {{ $space->price_daily ?? 0 }},
                            priceWeekly: {{ $space->price_weekly ?? 0 }},
                            priceMonthly: {{ $space->price_monthly ?? 0 }}
                         })">
                        <!-- Duplicate Form Content Here (Simplified) -->
                        <form action="{{ route('booking.store') }}" method="POST" class="space-y-4"
                            @submit.prevent="submitBooking($event)">
                            @csrf
                            <input type="hidden" name="space_id" value="{{ $space->id }}">
                            <input type="hidden" name="pricing_type" x-model="pricingType">
                            <input type="hidden" name="end_time" x-model="endTime">

                            <!-- Type Toggle -->
                            <div class="flex bg-gray-100 p-1 rounded-lg">
                                <template x-if="type == 'meeting_room'">
                                    <div class="grid grid-cols-4 gap-1 w-full">
                                        <button type="button" @click="setPricing('hourly')"
                                            :class="{'bg-white shadow text-gray-900': pricingType == 'hourly', 'text-gray-500': pricingType != 'hourly'}"
                                            class="py-1.5 rounded-md text-xs font-bold transition">Hourly</button>
                                        <button type="button" @click="setPricing('3_hours')"
                                            :class="{'bg-white shadow text-gray-900': pricingType == '3_hours', 'text-gray-500': pricingType != '3_hours'}"
                                            class="py-1.5 rounded-md text-xs font-bold transition">3 Hours</button>
                                        <button type="button" @click="setPricing('6_hours')"
                                            :class="{'bg-white shadow text-gray-900': pricingType == '6_hours', 'text-gray-500': pricingType != '6_hours'}"
                                            class="py-1.5 rounded-md text-xs font-bold transition">6 Hours</button>
                                        <button type="button" @click="setPricing('daily')"
                                            :class="{'bg-white shadow text-gray-900': pricingType == 'daily', 'text-gray-500': pricingType != 'daily'}"
                                            class="py-1.5 rounded-md text-xs font-bold transition">Daily</button>
                                    </div>
                                </template>
                                <template x-if="type == 'office_space'">
                                    <div class="flex w-full">
                                        <button type="button" @click="setPricing('weekly')"
                                            :class="{'bg-white shadow text-gray-900': pricingType == 'weekly', 'text-gray-500': pricingType != 'weekly'}"
                                            class="flex-1 py-1.5 rounded-md text-sm font-bold transition">Weekly</button>
                                        <button type="button" @click="setPricing('monthly')"
                                            :class="{'bg-white shadow text-gray-900': pricingType == 'monthly', 'text-gray-500': pricingType != 'monthly'}"
                                            class="flex-1 py-1.5 rounded-md text-sm font-bold transition">Monthly</button>
                                    </div>
                                </template>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Start
                                    Date</label>
                                <input type="text" x-ref="startPicker" placeholder="Select Date"
                                    class="w-full rounded-lg border-gray-300 font-bold">
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="flex-1">
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Duration</label>
                                    <div class="flex items-center gap-2">
                                        <button type="button" @click="decrementDuration()"
                                            class="w-8 h-8 rounded bg-gray-100 font-bold">-</button>
                                        <span x-text="duration" class="font-bold"></span>
                                        <button type="button" @click="incrementDuration()"
                                            class="w-8 h-8 rounded bg-gray-100 font-bold">+</button>
                                    </div>
                                </div>
                                <div class="flex-1 text-right">
                                    <span
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Total</span>
                                    <span class="font-bold text-xl text-brand"
                                        x-text="'IDR ' + (total).toLocaleString('id-ID')"></span>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-brand text-white font-bold py-3 rounded-xl">Request
                                to
                                Book</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                @if($errors->any())
                    Swal.fire({
                        icon: 'error',
                        title: 'Booking Failed',
                        html: `
                            <ul class="text-left">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        `,
                        confirmButtonColor: '#10B981', // Brand Green
                        confirmButtonText: 'OK'
                    });
                @endif
            });

            document.addEventListener('alpine:init', () => {
                Alpine.data('bookingCalculator', (config) => ({
                    type: config.type,
                    pricingType: config.type === 'meeting_room' ? 'hourly' : 'daily', // Default
                    priceHourly: config.priceHourly,
                    price3Hours: config.price3Hours,
                    price6Hours: config.price6Hours,
                    priceDaily: config.priceDaily,
                    priceWeekly: config.priceWeekly,
                    priceMonthly: config.priceMonthly,

                    duration: 1,
                    bookingDate: null,
                    startTime: '13:00', // Default
                    endTime: null,
                    subtotal: 0,
                    total: 0,
                    loading: false,
                    errorMessage: '',

                    get formattedPrice() {
                        if (this.pricingType == 'hourly') return (this.priceHourly).toLocaleString('id-ID');
                        if (this.pricingType == '3_hours') return (this.price3Hours).toLocaleString('id-ID');
                        if (this.pricingType == '6_hours') return (this.price6Hours).toLocaleString('id-ID');
                        if (this.pricingType == 'daily') return (this.priceDaily).toLocaleString('id-ID');
                        if (this.pricingType == 'weekly') return (this.priceWeekly).toLocaleString('id-ID');
                        return (this.priceMonthly).toLocaleString('id-ID');
                    },
                    get pricingLabel() {
                        if (this.pricingType == 'hourly') return 'hour';
                        if (this.pricingType.includes('hours')) return 'package';
                        if (this.pricingType == 'daily') return 'day';
                        if (this.pricingType == 'weekly') return 'week';
                        return 'month';
                    },
                    get durationUnitLabel() {
                        const map = {
                            'hourly': 'Hours',
                            '3_hours': 'Packages',
                            '6_hours': 'Packages',
                            'daily': 'Days',
                            'weekly': 'Weeks',
                            'monthly': 'Months'
                        };
                        return map[this.pricingType] || 'Units';
                    },
                    get summaryLabel() {
                        let price = 0;
                        if (this.pricingType == 'hourly') price = this.priceHourly;
                        else if (this.pricingType == '3_hours') price = this.price3Hours;
                        else if (this.pricingType == '6_hours') price = this.price6Hours;
                        else if (this.pricingType == 'daily') price = this.priceDaily;
                        else if (this.pricingType == 'weekly') price = this.priceWeekly;
                        else price = this.priceMonthly;

                        return `IDR ${price.toLocaleString('id-ID')} x ${this.duration}`;
                    },

                    init() {
                        // Initialize Flatpickr for DATE ONLY
                        flatpickr(this.$refs.datePicker, {
                            dateFormat: "Y-m-d",
                            minDate: "today",
                            defaultDate: "today",
                            onChange: (selectedDates) => {
                                this.bookingDate = selectedDates[0];
                                this.calculateTotal();
                            }
                        });
                        this.bookingDate = new Date(); // Warning: timezone issues might occur, but okay for MVP
                        this.calculateTotal();

                        this.$watch('pricingType', () => { this.duration = 1; this.calculateTotal(); });
                        this.$watch('duration', () => this.calculateTotal());
                    },

                    setPricing(type) {
                        this.pricingType = type;
                    },

                    calculateTotal() {
                        let price = 0;
                        if (this.pricingType == 'hourly') price = this.priceHourly;
                        else if (this.pricingType == '3_hours') price = this.price3Hours;
                        else if (this.pricingType == '6_hours') price = this.price6Hours;
                        else if (this.pricingType == 'daily') price = this.priceDaily;
                        else if (this.pricingType == 'weekly') price = this.priceWeekly;
                        else price = this.priceMonthly;

                        // Fallbacks  if (price === 0 && this.pricingType == 'hourly') price = this.priceDaily / 8;

                        this.subtotal = price * this.duration;
                        this.total = this.subtotal;

                        // Calculate EndTime needed for backend validation (rough estimation)
                        // This logic is duplicated in backend, mainly for visual or check if needed
                    },

                    submitBooking(e) {
                        // Native form submission, validation handled by required attributes
                        this.loading = true;
                        e.target.submit();
                    }
                }));
            });
        </script>
</x-app-layout>