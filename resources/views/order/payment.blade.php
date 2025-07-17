<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('output.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
</head>
<body>
    {{-- ===================== FLASH / VALIDATION MESSAGE ===================== --}}
    <div class="max-w-[1200px] mx-auto mt-4 px-4 md:px-8">
        @if(session('error'))
            <div class="bg-red-100 text-red-700 border border-red-300 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 border border-red-300 px-4 py-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif
    </div>

    {{-- =====================  FORM  ===================== --}}
    <form
        method="POST"
        enctype="multipart/form-data"
        action="{{ route('paymentConfirm') }}"
        class="relative flex flex-col w-full max-w-[1200px] min-h-screen gap-5 mx-auto bg-[#F5F5F0]"
    >
        @csrf

        {{-- ===================== TOP BAR ===================== --}}
        <div id="top-bar" class="flex justify-between items-center px-4 md:px-8 mt-[30px]">
            <a href="{{ route('front.customer_data') }}">
                <img src="{{ asset('assets/images/icons/back.svg') }}" class="w-10 h-10 md:w-12 md:h-12" alt="Back">
            </a>
            <p class="font-bold text-lg md:text-xl leading-[27px]">Review &amp; Payment</p>
            <div class="w-10 md:w-12"></div>
        </div>

        {{-- ===================== YOUR ORDER ===================== --}}
        <section id="your-order" class="accordion flex flex-col rounded-[20px] p-4 md:p-6 pb-5 gap-5 mx-4 md:mx-8 bg-white overflow-hidden transition-all duration-300 has-[:checked]:!h-[66px]">
            <label class="group flex items-center justify-between cursor-pointer">
                <h2 class="font-bold text-xl md:text-2xl leading-[30px]">Your Order</h2>
                <img src="{{ asset('assets/images/icons/arrow-up.svg') }}" class="w-7 h-7 md:w-8 md:h-8 transition-transform duration-300 group-has-[:checked]:rotate-180" alt="">
                <input type="checkbox" class="hidden">
            </label>

            <div class="flex items-center gap-[14px]">
                <div class="flex shrink-0 w-20 h-20 md:w-24 md:h-24 rounded-[20px] p-1 overflow-hidden">
                    <img src="{{ Storage::url($shoe->photos()->latest()->first()->photo) }}" class="w-full h-full object-contain" alt="">
                </div>
                <h3 class="font-bold text-lg md:text-xl leading-6">{{ $shoe->name }}</h3>
            </div>
            <hr class="border-[#EAEAED]">

            <div class="flex items-center justify-between"><p class="font-semibold md:text-lg">Brand</p><p class="font-bold md:text-lg">{{ $shoe->brand->name }}</p></div>
            <div class="flex items-center justify-between"><p class="font-semibold md:text-lg">Price</p><p class="font-bold md:text-lg">Rp {{ number_format($shoe->price,0,',','.') }}</p></div>
            <div class="flex items-center justify-between"><p class="font-semibold md:text-lg">Quantity</p><p class="font-bold md:text-lg">{{ $orderData['quantity'] ?? 1 }}</p></div>
            <div class="flex items-center justify-between"><p class="font-semibold md:text-lg">Shoe Size</p><p class="font-bold md:text-lg">{{ $orderData['shoe_size'] ?? 'Size not selected' }}</p></div>
        </section>

        {{-- ===================== CUSTOMER ===================== --}}
        <section id="customer" class="accordion flex flex-col rounded-[20px] p-4 md:p-6 pb-5 gap-5 mx-4 md:mx-8 bg-white overflow-hidden transition-all duration-300 has-[:checked]:!h-[66px]">
            <label class="group flex items-center justify-between cursor-pointer">
                <h2 class="font-bold text-xl md:text-2xl leading-[30px]">Customer</h2>
                <img src="{{ asset('assets/images/icons/arrow-up.svg') }}" class="w-7 h-7 md:w-8 md:h-8 transition-transform duration-300 group-has-[:checked]:rotate-180" alt="">
                <input type="checkbox" class="hidden">
            </label>

            <div class="flex items-center gap-5"><img src="{{ asset('assets/images/icons/user.svg') }}" class="w-6 h-6 md:w-7 md:h-7 shrink-0" alt=""><div><p class="font-semibold md:text-lg">Name</p><p class="font-bold md:text-lg">{{ $orderData['name'] ?? 'Not provided' }}</p></div></div>
            <div class="flex items-center gap-5"><img src="{{ asset('assets/images/icons/call.svg') }}" class="w-6 h-6 md:w-7 md:h-7 shrink-0" alt=""><div><p class="font-semibold md:text-lg">Phone No.</p><p class="font-bold md:text-lg">{{ $orderData['phone'] ?? 'Not provided' }}</p></div></div>
            <div class="flex items-center gap-5"><img src="{{ asset('assets/images/icons/sms.svg') }}" class="w-6 h-6 md:w-7 md:h-7 shrink-0" alt=""><div><p class="font-semibold md:text-lg">Email</p><p class="font-bold md:text-lg">{{ $orderData['email'] ?? 'Not provided' }}</p></div></div>
            <div class="flex items-center gap-5"><img src="{{ asset('assets/images/icons/house-2.svg') }}" class="w-6 h-6 md:w-7 md:h-7 shrink-0" alt=""><div><p class="font-semibold md:text-lg">Delivery to</p><p class="font-bold md:text-lg">{{ $orderData['address'] ?? 'Not provided' }}, {{ $orderData['post_code'] ?? 'Not provided' }}, {{ $orderData['city'] ?? 'Not provided' }}</p></div></div>
        </section>

        {{-- ===================== PAYMENT DETAILS ===================== --}}
        <section id="payment-details" class="accordion flex flex-col rounded-[20px] p-4 md:p-6 pb-5 gap-5 mx-4 md:mx-8 bg-white overflow-hidden transition-all duration-300 has-[:checked]:!h-[66px]">
            <label class="group flex items-center justify-between cursor-pointer">
                <h2 class="font-bold text-xl md:text-2xl leading-[30px]">Payment Details</h2>
                <img src="{{ asset('assets/images/icons/arrow-up.svg') }}" class="w-7 h-7 md:w-8 md:h-8 transition-transform duration-300 group-has-[:checked]:rotate-180" alt="">
                <input type="checkbox" class="hidden">
            </label>

            <div class="flex items-center justify-between"><p class="font-semibold md:text-lg">Sub Total</p><p class="font-bold md:text-lg">Rp {{ number_format($orderData['sub_total_amount'] ?? 0,0,',','.') }}</p></div>
            <div class="flex items-center justify-between"><p class="font-semibold md:text-lg">Promo Code</p><p class="font-bold md:text-lg">{{ $orderData['promo_code'] ?? '-' }}</p></div>
            <div class="flex items-center justify-between"><p class="font-semibold md:text-lg">Discount</p><p class="font-bold md:text-lg text-[#FF1943]">- Rp {{
                number_format($orderData['discount_amount'] ?? ($orderData['total_discount_amount'] ?? 0),0,',','.')
            }}</p></div>
            <div class="flex items-center justify-between"><p class="font-semibold md:text-lg">PPN 11%</p><p class="font-bold md:text-lg">Rp {{ number_format($orderData['total_tax'] ?? 0,0,',','.') }}</p></div>
            <div class="flex items-center justify-between"><p class="font-semibold md:text-lg">Delivery</p><p class="font-bold md:text-lg">Rp 0</p></div>
            <div class="flex items-center justify-between"><p class="font-semibold md:text-lg">Grand Total</p><p class="font-bold text-2xl md:text-3xl leading-9 text-[#07B704]">Rp {{ number_format($orderData['grand_total_amount'] ?? 0,0,',','.') }}</p></div>
        </section>

        {{-- ===================== SEND PAYMENT TO ===================== --}}
        <section id="send-payment-to" class="accordion flex flex-col rounded-[20px] p-4 md:p-6 pb-5 gap-5 mx-4 md:mx-8 bg-white overflow-hidden transition-all duration-300 has-[:checked]:!h-[66px]">
            <label class="group flex items-center justify-between cursor-pointer">
                <h2 class="font-bold text-xl md:text-2xl leading-[30px]">Send Payment to</h2>
                <img src="{{ asset('assets/images/icons/arrow-up.svg') }}" class="w-7 h-7 md:w-8 md:h-8 transition-transform duration-300 group-has-[:checked]:rotate-180" alt="">
                <input type="checkbox" class="hidden">
            </label>

            {{-- rekening BCA --}}
            <div class="flex items-center gap-3">
                <div class="w-[71px] h-[50px] md:w-[80px] md:h-[56px] shrink-0 overflow-hidden">
                    <img src="{{ asset('assets/images/logos/bca-bank-central-asia 1.svg') }}" class="w-full h-full object-contain" alt="BCA">
                </div>
                <div><p class="font-semibold md:text-lg flex items-center">Gemma Luly <img src="{{ asset('assets/images/icons/verify.svg') }}" class="ml-1 md:w-5 md:h-5" alt=""></p><p class="md:text-lg">8008129839</p></div>
            </div>

            {{-- rekening Mandiri --}}
            <div class="flex items-center gap-3">
                <div class="w-[71px] h-[50px] md:w-[80px] md:h-[56px] shrink-0 overflow-hidden">
                    <img src="{{ asset('assets/images/logos/bank-mandiri 1.svg') }}" class="w-full h-full object-contain" alt="Mandiri">
                </div>
                <div><p class="font-semibold md:text-lg flex items-center">Gemma Luly <img src="{{ asset('assets/images/icons/verify.svg') }}" class="ml-1 md:w-5 md:h-5" alt=""></p><p class="md:text-lg">12379834983281</p></div>
            </div>

            <hr class="border-[#EAEAED]">

            {{-- upload bukti --}}
            <div class="flex flex-col gap-2">
                <label for="Proof" class="font-semibold md:text-lg">Bukti Transfer</label>
                <div class="group w-full rounded-full px-[14px] md:px-[16px] flex items-center ring-1 ring-[#090917] gap-[10px] relative transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                    <img src="{{ asset('assets/images/icons/security-card.svg') }}" class="w-6 h-6 md:w-7 md:h-7 shrink-0" alt="">
                    <span id="file-name" class="flex-1 py-[14px] md:py-[16px] text-sm md:text-base text-[#878785] truncate">Add an attachment</span>
                    <button type="button" class="text-sm md:text-base font-medium px-3 py-2 md:px-4 md:py-3" onclick="document.getElementById('Proof').click()">Browse</button>
                    <input type="file" accept="image/*" name="proof" id="Proof" class="absolute inset-0 opacity-0 -z-10" required>
                </div>
            </div>

            <hr class="border-[#EAEAED]">
            <div class="flex items-center gap-[10px]">
                <img src="{{ asset('assets/images/icons/shield-tick.svg') }}" class="w-8 h-8 md:w-10 md:h-10 shrink-0" alt="">
                <p class="leading-[26px] md:text-lg md:leading-[28px]">Kami melindungi data privasi anda dengan baik.</p>
            </div>
        </section>

        {{-- ===================== BOTTOM BAR ===================== --}}
        <div id="bottom-nav" class="relative flex h-[100px] w-full shrink-0 mt-5">
            <div class="fixed bottom-5 w-full max-w-[1200px] z-30 px-4 mx-auto left-0 right-0">
                <div class="flex items-center justify-between rounded-full bg-[#2A2A2A] p-[10px] pl-6 md:px-8">
                    <p class="text-white mr-2 md:text-lg">Apakah anda sudah benar membayar?</p>
                    <button type="submit" class="rounded-full p-[12px_20px] md:p-[14px_24px] bg-[#C5F277] font-bold md:text-lg whitespace-nowrap">
                        Confirm Now
                    </button>
                </div>
            </div>
        </div>
    </form>

    {{-- ===================== SCRIPT ===================== --}}
    <script>
        // tampilkan nama file yang dipilih
        document.getElementById('Proof').addEventListener('change', function(e){
            const fileName = e.target.files.length ? e.target.files[0].name : 'Add an attachment';
            document.getElementById('file-name').textContent = fileName;
        });
    </script>
    <script src="{{ asset('js/accordion.js') }}"></script>
    <script src="{{ asset('js/payment.js') }}"></script>
</body>
</html>
