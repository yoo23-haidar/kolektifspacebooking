@extends('layouts.admin')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Space Inventory</h1>
        <p class="text-gray-500">Manage your rooms and desks.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Space</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Capacity</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Price (Base)</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>

                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach (\App\Models\Space::all() as $space)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <img src="{{ $space->image }}" alt="{{ $space->name }}"
                                    class="w-12 h-12 rounded-lg object-cover bg-gray-200">
                                <div>
                                    <p class="font-bold text-gray-800">{{ $space->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $space->location }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold uppercase tracking-wide">{{ str_replace('_', ' ', $space->type) }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $space->capacity }} Pax
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">
                            @if($space->price_hourly)
                                IDR {{ number_format((float) $space->price_hourly) }} /hr
                            @elseif($space->price_daily)
                                IDR {{ number_format((float) $space->price_daily) }} /day
                            @elseif($space->price_monthly)
                                IDR {{ number_format((float) $space->price_monthly) }} /mo
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($space->is_active)
                                <form action="{{ route('admin.spaces.toggle-active', $space) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center gap-2 text-green-600 text-sm font-bold hover:text-green-700 transition"
                                        title="Click to Deactivate">
                                        <span class="w-2 h-2 rounded-full bg-green-500"></span> Active
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.spaces.toggle-active', $space) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center gap-2 text-red-500 text-sm font-bold hover:text-red-700 transition"
                                        title="Click to Activate">
                                        <span class="w-2 h-2 rounded-full bg-red-500"></span> Inactive
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection