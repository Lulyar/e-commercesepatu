<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('output.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
</head>
<body>
    <div class="relative flex flex-col w-full max-w-[1200px] min-h-screen gap-5 mx-auto bg-[#F5F5F0]">
        <div class="flex flex-col items-center justify-center px-4 md:px-8 gap-[30px] md:gap-[40px] my-auto">
            <div class="w-[330px] h-[196px] md:w-[400px] md:h-[240px] overflow-hidden">
                <img src="{{ Storage::url(optional($order->shoe->photos()->latest()->first())->photo ?? 'assets/images/placeholder.png') }}"
                     class="w-full h-full object-contain" alt="thumbnail">
            </div>

            <div class="flex flex-col w-full max-w-[340px] md:max-w-[500px] rounded-[20px] p-[20px_16px_30px_16px] md:p-[30px_24px_40px_24px] gap-[30px] md:gap-[40px] bg-white">
                <div class="text-center space-y-[10px] md:space-y-[15px]">
                    <h1 class="font-bold text-xl md:text-2xl leading-[30px] md:leading-[36px]">New Shoes Coming!</h1>
                    <p class="leading-[30px] md:text-lg md:leading-[32px]">
                        Kami akan memeriksa pesanan anda,<br>
                        silakan cek status pesanan secara berkala.
                    </p>
                </div>

                <div class="flex items-center justify-between rounded-2xl border-2 border-[#FFC700] border-dashed p-[12px_16px] md:p-[16px_20px]">
                    <div class="flex items-center gap-[10px] md:gap-[12px]">
                        <img src="{{ asset('assets/images/icons/delivery.svg') }}" class="w-8 h-8 md:w-10 md:h-10 shrink-0" alt="icon">
                        <p class="md:text-lg">Booking ID <span class="font-bold">{{ $order->booking_trx_id }}</span></p>
                    </div>
                    <img src="{{ asset('assets/images/icons/verify.svg') }}" class="w-6 h-6 md:w-7 md:h-7" alt="icon">
                </div>

                <!-- Check Booking Section -->
                <div class="flex flex-col gap-3">
                    <div class="text-center">
                        <h3 class="font-semibold text-lg md:text-xl mb-3">Cek Status Pesanan</h3>
                        <p class="text-sm md:text-base text-gray-600 mb-4">Masukkan Booking ID untuk melihat status pesanan Anda</p>
                    </div>
                    
                    <form method="POST" action="{{ route('front.check_booking_details') }}" class="flex flex-col gap-3">
                        @csrf
                        <div class="flex flex-col gap-2">
                            <label for="booking-id" class="font-semibold text-sm md:text-base">Booking ID</label>
                            <div class="flex items-center w-full rounded-full px-[14px] md:px-[16px] gap-[10px] overflow-hidden bg-[#F8F8F9] transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                                <img src="{{ asset('assets/images/icons/delivery.svg') }}" class="w-6 h-6 md:w-7 md:h-7 flex shrink-0" alt="icon">
                                <input type="text" name="booking_trx_id" id="booking-id" 
                                    class="appearance-none outline-none bg-[#F8F8F9] w-full font-semibold text-sm md:text-base placeholder:font-normal py-[14px] md:py-[16px]" 
                                    placeholder="Masukkan Booking ID Anda">
                            </div>
                        </div>
                        
                        <div class="flex flex-col gap-2">
                            <label for="phone" class="font-semibold text-sm md:text-base">Nomor Telepon</label>
                            <div class="flex items-center w-full rounded-full px-[14px] md:px-[16px] gap-[10px] overflow-hidden bg-[#F8F8F9] transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                                <img src="{{ asset('assets/images/icons/call.svg') }}" class="w-6 h-6 md:w-7 md:h-7 flex shrink-0" alt="icon">
                                <input type="tel" name="phone" id="phone" 
                                    class="appearance-none outline-none bg-[#F8F8F9] w-full font-semibold text-sm md:text-base placeholder:font-normal py-[14px] md:py-[16px]" 
                                    placeholder="Masukkan nomor telepon Anda">
                            </div>
                        </div>
                        
                        <button type="submit" class="rounded-full p-[12px_20px] md:p-[14px_24px] text-center w-full bg-[#C5F277] font-bold text-sm md:text-base">
                            Cek Status Pesanan
                        </button>
                    </form>
                </div>

                <!-- Feature Buttons Section -->
                <div class="flex flex-col gap-3">
                    <button onclick="contactSupport()" class="flex items-center justify-center gap-2 rounded-full p-[10px_16px] md:p-[12px_20px] bg-[#FFF3CD] border border-[#FFC700] font-medium text-sm md:text-base">
                        <img src="{{ asset('assets/images/icons/24-support-white.svg') }}" class="w-5 h-5 md:w-6 md:h-6" alt="support">
                        Contact Support
                    </button>
                </div>

                <div class="flex flex-col gap-3">
                    <a href="{{ route('front.index') }}"
                       class="rounded-full p-[12px_20px] md:p-[14px_24px] text-center w-full bg-[#F5F277] font-bold md:text-lg border-2 border-[#E5D267]">
                        Order More
                    </a>
                    <a href="{{ route('front.check_booking') }}" class="rounded-full p-[12px_20px] md:p-[14px_24px] text-center w-full bg-[#009917] text-white font-bold md:text-lg border-none cursor-pointer text-decoration-none block">
                        Cek Booking Lain
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function contactSupport() {
            // Implement contact support functionality
            window.open('https://wa.me/6285727997837?text=Hi, I need help with my order {{ $order->booking_trx_id }}', '_blank');
        }

        // Auto-fill booking ID when page loads
        document.addEventListener('DOMContentLoaded', function() {
            const bookingIdInput = document.getElementById('booking-id');
            if (bookingIdInput) {
                bookingIdInput.value = '{{ $order->booking_trx_id }}';
                bookingIdInput.readOnly = true;
                bookingIdInput.style.backgroundColor = '#f0f0f0';
            }
        });
    </script>
</body>
</html>
