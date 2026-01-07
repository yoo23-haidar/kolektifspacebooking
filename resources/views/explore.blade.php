<x-app-layout>
    <!-- Search Header (Sticky) -->
    <div class="sticky top-0 z-30 bg-white shadow-sm border-b border-gray-100 px-4 py-4">
        <div class="max-w-7xl mx-auto flex gap-4 items-center">
            <!-- Search Input -->
            <form action="{{ route('explore') }}" method="GET" class="flex-1 relative">
                <input type="hidden" name="type" value="{{ request('type') }}">
                <svg class="absolute left-4 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" name="search" placeholder="Search spaces, desks, rooms..." value="{{ request('search') }}"
                    class="w-full pl-12 pr-4 py-3 bg-gray-100 border-none rounded-xl font-medium focus:ring-2 focus:ring-brand focus:bg-white transition placeholder-gray-400">
            </form>

            <!-- Filter Button (Trigger) -->
            <x-filter-modal>
                <x-slot name="trigger">
                    <button
                        class="p-3 border border-gray-200 rounded-xl hover:border-brand hover:text-brand transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                            </path>
                        </svg>
                    </button>
                </x-slot>
            </x-filter-modal>
        </div>

        <!-- Categories & Map Toggle -->
        <div class="max-w-7xl mx-auto mt-4 flex justify-between items-center overflow-x-hidden">
            <div class="flex gap-2 text-sm overflow-x-auto hide-scrollbar">
                <a href="{{ route('explore') }}" 
                   class="{{ !request('type') ? 'bg-brand-dark text-white' : 'bg-white border border-gray-200 text-gray-600 hover:border-brand' }} px-4 py-1.5 rounded-full font-medium whitespace-nowrap transition">
                   All Spaces
                </a>

                <a href="{{ route('explore', ['type' => 'meeting_room']) }}"
                   class="{{ request('type') == 'meeting_room' ? 'bg-brand-dark text-white' : 'bg-white border border-gray-200 text-gray-600 hover:border-brand' }} px-4 py-1.5 rounded-full font-medium whitespace-nowrap transition">
                   Meeting Rooms
                </a>
                <a href="{{ route('explore', ['type' => 'office_space']) }}"
                   class="{{ request('type') == 'office_space' ? 'bg-brand-dark text-white' : 'bg-white border border-gray-200 text-gray-600 hover:border-brand' }} px-4 py-1.5 rounded-full font-medium whitespace-nowrap transition">
                   Office Spaces
                </a>
            </div>

            <!-- List/Map Toggle Removed -->
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 pb-24">
        <!-- Results Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($spaces as $space)
            <a href="{{ route('space.show', $space) }}"
                class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition block group overflow-hidden border border-gray-100 h-full flex flex-col">
                <div class="relative h-56 shrink-0">
                    <img src="{{ $space->image }}"
                        alt="{{ $space->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

                    <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-brand-dark">
                         {{ ucfirst(str_replace('_', ' ', $space->type)) }}
                    </div>
                </div>
                <div class="p-5 flex flex-col flex-1">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h3 class="font-bold text-lg text-gray-900 group-hover:text-brand transition">{{ $space->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $space->location }}</p>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="font-bold text-brand-DEFAULT">
                                @if($space->price_daily)
                                    IDR {{ number_format($space->price_daily / 1000) }}k
                                @elseif($space->price_weekly)
                                    IDR {{ number_format($space->price_weekly / 1000) }}k
                                @else
                                    Ask
                                @endif
                            </span>
                            <span class="text-xs text-gray-400">
                                @if($space->price_daily) /day @elseif($space->price_weekly) /week @endif
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 text-xs text-gray-500 mt-auto pt-4 border-t border-gray-50">
                        <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg> {{ $space->capacity }} Pax</span>
                        
                        @if($space->dimensions)
                        <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                </svg> {{ $space->dimensions }}</span>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</x-app-layout>