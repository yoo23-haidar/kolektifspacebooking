<x-app-layout>
    <!-- Hero Section -->
    <div class="relative h-[80vh] w-full overflow-hidden">
        <!-- Background Image -->
        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
            alt="Kolektif Space Workspace" class="absolute inset-0 w-full h-full object-cover">

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-transparent to-brand-dark/90"></div>

        <!-- Content -->
        <div class="absolute inset-0 flex flex-col justify-center items-center px-4 text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 drop-shadow-lg tracking-tight">
                Find Your <span class="italic font-serif text-brand-light">Flow</span> State
            </h1>
            <p class="text-white/90 text-lg md:text-xl mb-8 max-w-2xl drop-shadow-md">
                Premium workspaces in Jakarta designed for creators, startups, and remote teams.
            </p>

            <!-- Smart Search Bar -->
            <form action="{{ route('explore') }}" method="GET" class="w-full max-w-3xl">
                <div x-data="{ guests: 1 }"
                    class="bg-white p-4 rounded-2xl shadow-xl w-full flex flex-col md:flex-row gap-4 items-center">
                    <!-- Space Type -->
                    <div class="flex-1 w-full relative group">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1 text-center md:text-left">Space
                            Type</label>
                        <div class="flex items-center gap-2 justify-center md:justify-start">
                            <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            <select name="type"
                                class="w-auto md:w-full border-none p-0 pr-8 text-brand-dark font-bold focus:ring-0 bg-transparent cursor-pointer text-center md:text-left form-select bg-no-repeat bg-right">
                                <option value="">All Spaces</option>
                                <option value="meeting_room">Meeting Room</option>
                                <option value="office_space">Office Space</option>
                            </select>
                        </div>
                    </div>

                    <div class="hidden md:block w-px h-12 bg-gray-200"></div>

                    <!-- Date -->
                    <div class="flex-1 w-full">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1 text-center md:text-left">Date</label>
                        <div class="flex items-center gap-2 justify-center md:justify-start">
                            <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <input type="date" name="date"
                                class="w-auto md:w-full border-none p-0 text-brand-dark font-bold focus:ring-0 bg-transparent text-center md:text-left"
                                value="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="hidden md:block w-px h-12 bg-gray-200"></div>

                    <!-- Guests -->
                    <div class="flex-1 w-full">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1 text-center md:text-left">Guests</label>
                        <div class="flex items-center gap-2 h-6 justify-center md:justify-start">
                            <button type="button" @click="guests > 1 ? guests-- : null"
                                class="w-6 h-6 rounded-full bg-gray-100 text-brand flex items-center justify-center hover:bg-gray-200">-</button>
                            <span x-text="guests + ' People'"
                                class="font-bold text-brand-dark min-w-[3rem] text-center text-sm"></span>
                            <input type="hidden" name="guests" x-model="guests">
                            <button type="button" @click="guests++"
                                class="w-6 h-6 rounded-full bg-gray-100 text-brand flex items-center justify-center hover:bg-gray-200">+</button>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <button type="submit"
                        class="w-full md:w-auto bg-brand hover:bg-brand-dark text-white rounded-xl px-8 py-4 font-bold transition shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Categories Rail -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
        <div
            class="grid grid-cols-2 gap-4 py-4 md:flex md:gap-4 md:overflow-x-auto md:hide-scrollbar md:snap-x md:justify-center">
            <!-- Card 1 -->

            <!-- Card 2 -->
            <a href="{{ route('explore', ['type' => 'office_space']) }}"
                class="w-full md:snap-center md:shrink-0 md:w-40 bg-white rounded-2xl shadow-lg p-4 flex flex-col items-center justify-center gap-3 hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center text-brand">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                </div>
                <span class="text-sm font-bold text-gray-700">Private Office</span>
            </a>
            <!-- Card 3 -->
            <a href="{{ route('explore', ['type' => 'meeting_room']) }}"
                class="w-full md:snap-center md:shrink-0 md:w-40 bg-white rounded-2xl shadow-lg p-4 flex flex-col items-center justify-center gap-3 hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center text-brand">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
                <span class="text-sm font-bold text-gray-700">Meeting Room</span>
            </a>
            <!-- Card 4 -->
        </div>
    </div>

    <!-- Featured Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Popular Spaces</h2>
                <p class="text-gray-500 mt-1">Book a desk in our mosr requested locations.</p>
            </div>
            <a href="#" class="text-brand font-bold text-sm hover:underline">View All</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($featuredSpaces as $space)
                <div
                    class="group bg-white rounded-3xl overflow-hidden border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $space->image }}" alt="{{ $space->name }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div
                            class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-brand shadow-sm">
                            {{ $space->type == 'office_space' ? 'Office' : 'Meeting' }}
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="font-bold text-xl text-brand-dark mb-1">{{ $space->name }}</h3>
                                <p class="text-sm text-gray-500 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $space->location }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 text-sm text-gray-500 mb-6">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                {{ $space->capacity }} People
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                High Speed Wifi
                            </span>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div>
                                <span class="text-xs text-gray-400 uppercase font-bold">Starting from</span>
                                <div class="text-brand font-bold text-lg">
                                    @if($space->price_daily)
                                        IDR {{ number_format($space->price_daily / 1000) }}k <span
                                            class="text-sm font-normal text-gray-400">/day</span>
                                    @elseif($space->price_weekly)
                                        IDR {{ number_format($space->price_weekly / 1000) }}k <span
                                            class="text-sm font-normal text-gray-400">/week</span>
                                    @else
                                        Ask for Price
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('space.show', $space) }}"
                                class="bg-brand-cream text-brand-dark px-4 py-2 rounded-xl font-bold text-sm hover:bg-brand hover:text-white transition">
                                Book
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>