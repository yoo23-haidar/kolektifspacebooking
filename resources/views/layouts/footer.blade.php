<footer class="bg-brand-dark text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
            <!-- Brand -->
            <div class="col-span-1 md:col-span-1">
                <div class="flex items-center gap-2 mb-4">
                    <x-application-logo class="w-8 h-8 fill-current text-white" />
                    <span class="font-bold text-xl tracking-wide">KOLEKTIF</span>
                </div>
                <p class="text-brand-light text-sm leading-relaxed">
                    Premium workspaces designed for productivity and connection in the heart of Jakarta.
                </p>
            </div>

            <!-- Links -->
            <div>
                <h4 class="font-bold mb-4">Explore</h4>
                <ul class="space-y-2 text-brand-light text-sm">
                    <li><a href="{{ route('explore') }}?type=office_space" class="hover:text-white transition">Private
                            Offices</a></li>
                    <li><a href="{{ route('explore') }}?type=meeting_room" class="hover:text-white transition">Meeting
                            Rooms</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h4 class="font-bold mb-4">Support</h4>
                <ul class="space-y-2 text-brand-light text-sm">
                    <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                    <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                    <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h4 class="font-bold mb-4">Stay Updated</h4>
                <form class="flex flex-col gap-2">
                    <input type="email" placeholder="Enter your email"
                        class="bg-brand text-white border-brand-light/20 rounded-lg px-4 py-2 text-sm placeholder-brand-light/50 focus:ring-brand-light focus:border-brand-light">
                    <button type="button"
                        class="bg-brand-light text-brand-dark font-bold py-2 rounded-lg hover:bg-white transition text-sm">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        <div
            class="border-t border-brand-light/20 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-brand-light">
            <p>&copy; {{ date('Y') }} Kolektif Space. All rights reserved.</p>
            <div class="flex gap-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-white">Instagram</a>
                <a href="#" class="hover:text-white">LinkedIn</a>
            </div>
        </div>
    </div>
</footer>