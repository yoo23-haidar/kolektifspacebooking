@props(['trigger' => 'Open Filters'])

<div x-data="{ open: false }" class="inline-block">
    <!-- Trigger Button -->
    <div @click="open = true">
        {{ $trigger }}
    </div>

    <!-- Backdrop -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="open = false"
        class="fixed inset-0 bg-black/50 z-50"></div>

    <!-- Modal / Bottom Sheet -->
    <div x-show="open" x-transition:enter="transition transform ease-out duration-300"
        x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
        x-transition:leave="transition transform ease-in duration-300" x-transition:leave-start="translate-y-0"
        x-transition:leave-end="translate-y-full"
        class="fixed bottom-0 left-0 right-0 bg-white rounded-t-3xl z-50 max-h-[85vh] overflow-y-auto pb-safe">

        <div class="p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-900">Filters</h2>
                <button @click="open = false" class="p-2 bg-gray-100 rounded-full hover:bg-gray-200 text-gray-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="space-y-6">
                <!-- Price Range -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Price Range</label>
                    <div class="flex items-center gap-4">
                        <div class="flex-1">
                            <span class="text-xs text-gray-500 block">Min</span>
                            <div class="relative mt-1">
                                <span class="absolute left-3 top-2.5 text-gray-500 text-sm">IDR</span>
                                <input type="number"
                                    class="w-full pl-10 rounded-xl border-gray-300 focus:border-brand focus:ring-brand font-bold"
                                    value="100000">
                            </div>
                        </div>
                        <div class="flex-1">
                            <span class="text-xs text-gray-500 block">Max</span>
                            <div class="relative mt-1">
                                <span class="absolute left-3 top-2.5 text-gray-500 text-sm">IDR</span>
                                <input type="number"
                                    class="w-full pl-10 rounded-xl border-gray-300 focus:border-brand focus:ring-brand font-bold"
                                    value="5000000">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Amenities -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Amenities</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label
                            class="flex items-center gap-2 p-3 border rounded-xl hover:border-brand cursor-pointer transition">
                            <input type="checkbox" class="rounded text-brand focus:ring-brand">
                            <span class="text-sm font-medium">Monitor</span>
                        </label>
                        <label
                            class="flex items-center gap-2 p-3 border rounded-xl hover:border-brand cursor-pointer transition">
                            <input type="checkbox" class="rounded text-brand focus:ring-brand">
                            <span class="text-sm font-medium">Standing Desk</span>
                        </label>
                        <label
                            class="flex items-center gap-2 p-3 border rounded-xl hover:border-brand cursor-pointer transition">
                            <input type="checkbox" class="rounded text-brand focus:ring-brand">
                            <span class="text-sm font-medium">Private Booth</span>
                        </label>
                        <label
                            class="flex items-center gap-2 p-3 border rounded-xl hover:border-brand cursor-pointer transition">
                            <input type="checkbox" class="rounded text-brand focus:ring-brand">
                            <span class="text-sm font-medium">Projector</span>
                        </label>
                    </div>
                </div>

                <!-- Capacity -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Capacity</label>
                    <div class="flex gap-2 overflow-x-auto hide-scrollbar pb-2">
                        <button
                            class="px-4 py-2 border border-brand bg-brand-light/20 text-brand-dark rounded-full text-sm font-bold whitespace-nowrap">Any</button>
                        <button
                            class="px-4 py-2 border border-gray-200 hover:border-brand rounded-full text-gray-600 text-sm whitespace-nowrap">1-4
                            Pax</button>
                        <button
                            class="px-4 py-2 border border-gray-200 hover:border-brand rounded-full text-gray-600 text-sm whitespace-nowrap">5-10
                            Pax</button>
                        <button
                            class="px-4 py-2 border border-gray-200 hover:border-brand rounded-full text-gray-600 text-sm whitespace-nowrap">10+
                            Pax</button>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-8 pt-4 border-t border-gray-100">
                <button
                    class="w-full bg-brand-DEFAULT text-white font-bold py-3 rounded-xl shadow-lg hover:bg-brand-dark transition">
                    Show 24 Spaces
                </button>
            </div>
        </div>
    </div>
</div>