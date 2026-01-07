<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Timer & Status Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8"
            x-data="paymentTimer({{ $booking->created_at->addHours(2)->timestamp * 1000 }})">

            <!-- Header -->
            <div
                class="bg-green-50 border-b border-green-100 p-6 flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4 text-green-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Booking Requested!</h1>
                <p class="text-gray-500 mt-1">Please complete payment to secure your slot.</p>

                <div class="mt-6 bg-white border border-green-200 rounded-xl px-6 py-3 shadow-sm">
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-wide">Time remaining to
                        pay</span>
                    <span class="text-3xl font-mono font-bold text-red-600" x-text="formatted">02:00:00</span>
                </div>
            </div>

            <div class="p-8">
                <!-- Instruction -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8 rounded-r-lg">
                    <p class="text-sm text-blue-700">
                        Please transfer the total amount within <strong>2 hours</strong>, otherwise this booking will be
                        automatically canceled.
                    </p>
                </div>

                <!-- Bank Details -->
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 mb-8 relative">
                    <div
                        class="absolute top-0 right-0 bg-brand-light text-brand-dark text-xs font-bold px-3 py-1 rounded-bl-xl rounded-tr-xl">
                        Bank Transfer
                    </div>
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-12 h-12 bg-white rounded-lg shadow-sm flex items-center justify-center border border-gray-200 font-bold text-gray-400">
                            BCA
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Bank Central Asia</p>
                            <p class="font-bold text-gray-900">PT Kolektif Space Indonesia</p>
                        </div>
                    </div>

                    <div class="flex justify-between items-end bg-white border border-gray-200 rounded-xl p-4">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Account Number</p>
                            <p class="text-xl font-mono font-bold text-gray-900 tracking-wider">123-456-7890</p>
                        </div>
                        <button onclick="navigator.clipboard.writeText('1234567890'); alert('Copied!')"
                            class="text-sm font-bold text-brand hover:underline">
                            Copy
                        </button>
                    </div>

                    <div class="flex justify-between items-end bg-white border border-gray-200 rounded-xl p-4 mt-4">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Total Amount</p>
                            <p class="text-2xl font-bold text-brand-dark">IDR
                                {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        </div>
                        <button onclick="navigator.clipboard.writeText('{{ $booking->total_price }}'); alert('Copied!')"
                            class="text-sm font-bold text-brand hover:underline">
                            Copy
                        </button>
                    </div>
                </div>

                <!-- Booking Summary -->
                <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Booking Summary
                </h3>
                <div class="text-sm text-gray-600 space-y-3 mb-8 border-l-2 border-gray-100 pl-4">
                    <div>
                        <span class="block text-xs text-gray-400 font-bold uppercase">Order ID</span>
                        <span class="font-mono text-gray-900 font-bold">#{{ substr($booking->id, 0, 8) }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-gray-400 font-bold uppercase">Space</span>
                        <span class="font-bold text-gray-900">{{ $booking->space->name }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-gray-400 font-bold uppercase">Date & Time</span>
                        <span
                            class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($booking->booking_date)->format('D, d M Y') }},
                            {{ $booking->start_time->format('H:i') }}</span>
                    </div>
                </div>

                <!-- Action Button -->
                <a href="https://wa.me/6281234567890?text={{ urlencode('Hi Kolektif, I have paid for Order #' . substr($booking->id, 0, 8) . '. Here is the proof attached.') }}"
                    target="_blank"
                    class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition flex items-center justify-center gap-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.996.592 1.841.97 3.016.969 3.196 0 5.786-2.615 5.788-5.787.001-3.269-2.73-5.836-6.008-5.835zm4.836 8.355c-.2.531-1.071 1.025-1.503 1.066-.407.039-.884.053-2.673-.655-2.071-.818-3.411-2.91-3.514-3.048-.109-.138-.853-1.135-.853-2.164 0-1.029.544-1.536.735-1.745.163-.178.411-.252.667-.252.203 0 .406.002.576.008.232.008.486-.062.66.353.186.444.629 1.543.684 1.656.055.112.093.243.018.393-.075.149-.113.242-.222.372-.115.137-.245.303-.346.406-.114.116-.237.243-.102.477.134.233.593 1.059 1.393 1.77.949.843 1.873 1.138 2.222 1.258.291.1.58.058.752-.143.21-.247.78-1.002.946-1.309.166-.307.399-.253.715-.14 2.196.792 1.956.84 2.21 1.229.088.134.153.307.014.542z" />
                    </svg>
                    Confirm Payment via WhatsApp
                </a>

                <p class="text-center text-xs text-gray-400 mt-4">
                    Please attach your transfer screenshot in the WhatsApp chat.
                </p>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('paymentTimer', (expiryTimestamp) => ({
                expiry: expiryTimestamp,
                remaining: 0,
                formatted: '02:00:00',
                init() {
                    this.update();
                    setInterval(() => this.update(), 1000);
                },
                update() {
                    const now = new Date().getTime();
                    const distance = this.expiry - now;

                    if (distance < 0) {
                        this.formatted = '00:00:00';
                        return;
                    }

                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    this.formatted =
                        String(hours).padStart(2, '0') + ":" +
                        String(minutes).padStart(2, '0') + ":" +
                        String(seconds).padStart(2, '0');
                }
            }));
        });
    </script>
</x-app-layout>