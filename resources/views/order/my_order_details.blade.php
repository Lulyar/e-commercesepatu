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
            <div id="top-bar" class="flex justify-between items-center px-4 md:px-8 mt-[30px]">
                <a href="{{ route('front.check_booking') }}">
                    <img src="{{asset('assets/images/icons/back.svg')}}" class="w-10 h-10 md:w-12 md:h-12" alt="icon">
                </a>
                <p class="font-bold text-lg md:text-xl leading-[27px]">Booking Details</p>
                <div class="dummy-btn w-10 md:w-12"></div>
            </div>
            <section id="your-order" class="accordion flex flex-col rounded-[20px] p-4 md:p-6 pb-5 gap-5 mx-4 md:mx-8 bg-white overflow-hidden transition-all duration-300 has-[:checked]:!h-[66px]">
                <label class="group flex items-center justify-between">
                    <h2 class="font-bold text-xl md:text-2xl leading-[30px]">Your Order</h2>
                    <img src="{{asset('assets/images/icons/arrow-up.svg')}}" class="w-7 h-7 md:w-8 md:h-8 transition-all duration-300 group-has-[:checked]:rotate-180" alt="icon">
                    <input type="checkbox" class="hidden">
                </label>
                <div class="flex items-center gap-[14px]">
                    <div class="flex shrink-0 w-20 h-20 md:w-24 md:h-24 rounded-[20px] p-1 overflow-hidden">
                        @if($orderDetails->shoe->photos && $orderDetails->shoe->photos()->count() > 0)
                            <img src="{{ Storage::url($orderDetails->shoe->photos()->latest()->first()->photo) }}" class="w-full h-full object-contain" alt="">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500 text-xs md:text-sm">No Image</span>
                            </div>
                        @endif
                    </div>
                    <h3 class="font-bold text-lg md:text-xl leading-6">
                        {{ $orderDetails->shoe->name }}
                    </h3>
                </div>
                <hr class="border-[#EAEAED]">

                <div class="flex items-center justify-between">
                    <p class="font-semibold md:text-lg">Brand</p>
                    <p class="font-bold md:text-lg">{{ $orderDetails->shoe->brand->name ?? 'N/A' }}</p>
                </div>

                <div class="flex items-center justify-between">
    <p class="font-semibold md:text-lg">Price</p>
    <p class="font-bold md:text-lg">Rp {{ number_format($orderDetails->shoe->price, 0, ',', '.') }}</p>
</div>
<div class="flex items-center justify-between">
    <p class="font-semibold md:text-lg">Quantity</p>
    <p class="font-bold md:text-lg">{{ $orderDetails->quantity }} Pcs</p>
</div>
<div class="flex items-center justify-between">
    <p class="font-semibold md:text-lg">Shoe Size</p>
    <p class="font-bold md:text-lg">{{ $orderDetails->shoeSize->size }}</p>
</div>
<div class="flex items-center justify-between">
    <p class="font-semibold md:text-lg">Grand Total</p>
    <p class="font-bold text-2xl md:text-3xl leading-9 text-[#078704]">Rp {{ number_format($orderDetails->grand_total_amount, 0, ',', '.') }}</p>
</div>

                <div class="flex items-center justify-between">
                    <p class="font-semibold md:text-lg">Checkout At</p>
                    <p class="font-bold md:text-lg">{{ $orderDetails->created_at }}</p>

                </div>
                @if($orderDetails->is_paid)
    <div class="flex items-center justify-between">
        <p class="font-semibold md:text-lg">Status</p>
        <p class="rounded-full p-[6px_14px] md:p-[8px_16px] bg-[#078704] font-bold text-white leading-[21px] md:text-base">SUCCESS</p>
    </div>
@else
    <div class="flex items-center justify-between">
        <p class="font-semibold md:text-lg">Status</p>
        <p class="rounded-full p-[6px_14px] md:p-[8px_16px] bg-[#2A2A2A] font-bold text-white leading-[21px] md:text-base">PENDING</p>
    </div>
@endif

            </section>
            <section id="customer" class="accordion flex flex-col rounded-[20px] p-4 md:p-6 pb-5 gap-5 mx-4 md:mx-8 bg-white overflow-hidden transition-all duration-300 has-[:checked]:!h-[66px] mb-10">
                <label class="group flex items-center justify-between">
                    <h2 class="font-bold text-xl md:text-2xl leading-[30px]">Customer</h2>
                    <img src="{{asset('assets/images/icons/arrow-up.svg')}}" class="w-7 h-7 md:w-8 md:h-8 transition-all duration-300 group-has-[:checked]:rotate-180" alt="icon">
                    <input type="checkbox" class="hidden">
                </label>
                <div class="flex items-center gap-5">
                    <img src="{{asset('assets/images/icons/delivery.svg')}}" class="w-6 h-6 md:w-7 md:h-7 flex shrink-0" alt="icon">
                    <div class="flex flex-col gap-[6px]">
                        <p class="font-semibold md:text-lg">Booking ID</p>
                        <p class="font-bold md:text-lg">{{ $orderDetails->booking_trx_id }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-5">
                    <img src="{{ asset('assets/images/icons/user.svg') }}" class="w-6 h-6 md:w-7 md:h-7 flex shrink-0" alt="icon">
                    <div class="flex flex-col gap-[6px]">
                        <p class="font-semibold md:text-lg">Name</p>
                        <p class="font-bold md:text-lg">{{ $orderDetails->name }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-5">
                    <img src="{{ asset('assets/images/icons/call.svg') }}" class="w-6 h-6 md:w-7 md:h-7 flex shrink-0" alt="icon">
                    <div class="flex flex-col gap-[6px]">
                        <p class="font-semibold md:text-lg">Phone No.</p>
                        <p class="font-bold md:text-lg">{{ $orderDetails->phone }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-5">
                    <img src="{{ asset('assets/images/icons/sms.svg') }}" class="w-6 h-6 md:w-7 md:h-7 flex shrink-0" alt="icon">
                    <div class="flex flex-col gap-[6px]">
                        <p class="font-semibold md:text-lg">Email</p>
                        <p class="font-bold md:text-lg">{{ $orderDetails->email }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-5">
                    <img src="{{asset('assets/images/icons/house-2.svg')}}" class="w-6 h-6 md:w-7 md:h-7 flex shrink-0" alt="icon">
                    <div class="flex flex-col gap-[6px]">
                        <p class="font-semibold md:text-lg">Delivery to</p>
                        <p class="font-bold md:text-lg">
                            {{ $orderDetails->address }}, {{ $orderDetails->post_code }}, {{ $orderDetails->city }}
                        </p>
                    </div>
                </div>
                <hr class="border-[#EAEAED]">
                <a href="{{ route('front.index') }}" class="rounded-full p-[12px_20px] md:p-[14px_24px] text-center w-full bg-[#C5F277] font-bold md:text-lg">Back to Home</a>
                <hr class="border-[#EAEAED]">
                <div class="flex items-center gap-[10px]">
                    <img src="{{asset('assets/images/icons/shield-tick.svg')}}" class="w-8 h-8 md:w-10 md:h-10 flex shrink-0" alt="icon">
                    <p class="leading-[26px] md:text-lg md:leading-[28px]">Kami melindungi data privasi anda dengan baik.</p>
                </div>
            </section>
        </div>

        <script src="{{ asset('js/accordion.js') }}"></script>
    </body>
</html>
