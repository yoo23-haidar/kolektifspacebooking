<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-100 pb-safe sm:hidden z-50">
    <div class="flex justify-around items-center h-16">
        <!-- Explore (Home) -->
        <a href="{{ route('dashboard') }}"
            class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('dashboard') ? 'text-brand-DEFAULT' : 'text-gray-400' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <span class="text-[10px] font-medium">Explore</span>
        </a>

        <!-- Bookings -->
        <a href="#"
            class="flex flex-col items-center justify-center w-full h-full space-y-1 text-gray-400 hover:text-brand-DEFAULT">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="text-[10px] font-medium">Bookings</span>
        </a>

        <!-- Saved -->
        <a href="#"
            class="flex flex-col items-center justify-center w-full h-full space-y-1 text-gray-400 hover:text-brand-DEFAULT">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            <span class="text-[10px] font-medium">Saved</span>
        </a>

        <!-- Profile -->
        <!-- Profile -->
        <a href="{{ Auth::check() ? route('profile.edit') : route('login') }}"
            class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('profile.edit') ? 'text-brand-DEFAULT' : 'text-gray-400' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="text-[10px] font-medium">{{ Auth::check() ? 'Profile' : 'Log in' }}</span>
        </a>
    </div>
</div>