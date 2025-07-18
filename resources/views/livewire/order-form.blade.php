<div>
    <div class="flex w-[260px] h-[160px] md:w-[400px] md:h-[240px] shrink-0 overflow-hidden mx-auto mb-10">
        <img
            id="main-thumbnail"
            src="{{ Storage::url($shoe->photos()->latest()->first()->photo) }}"
            class="w-full h-full object-contain object-center"
            alt="thumbnail"
        />
    </div>

    <form wire:submit.prevent="submit" class="flex flex-col gap-5">
        @csrf

        <div class="flex flex-col rounded-[20px] p-4 mx-4 md:mx-auto md:max-w-[600px] pb-5 gap-5 bg-white">
            {{-- Shoe Info --}}
            <div id="info" class="flex items-center justify-between">
                <div class="flex flex-col">
                    <h1 id="title" class="font-bold text-[22px] md:text-[28px] leading-[30px] md:leading-[36px]">
                        {{ $shoe->name }}
                    </h1>
                    <p class="font-semibold text-lg md:text-xl leading-[27px] md:leading-[30px]">
                        Rp {{ number_format($shoe->price, 0, ',', '.') }} • {{ $orderData['shoe_size'] ?? 'Size not selected' }}
                    </p>
                </div>
                <div class="flex items-center gap-1">
                    <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-[26px] h-[26px]" alt="star" />
                    <span class="font-semibold text-xl leading-[30px]">4.5</span>
                </div>
            </div>

            <hr class="border-[#EAEAED]" />

            {{-- Name Input --}}
            <div class="flex flex-col gap-2">
                <label for="name" class="font-semibold">Complete Name</label>
                <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] gap-[10px] transition-all focus-within:ring-2 focus-within:ring-[#FFC700]">
                    <img src="{{ asset('assets/images/icons/user.svg') }}" class="w-6 h-6" alt="icon" />
                    <input
                        wire:model="name"
                        type="text"
                        name="name"
                        id="name"
                        class="w-full font-semibold py-[14px] md:py-[16px] outline-none placeholder:font-normal placeholder:text-[#878785]"
                        placeholder="Type your complete name"
                    />
                </div>
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            {{-- Email Input --}}
            <div class="flex flex-col gap-2">
                <label for="email" class="font-semibold">Email Address</label>
                <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] gap-[10px] transition-all focus-within:ring-2 focus-within:ring-[#FFC700]">
                    <img src="{{ asset('assets/images/icons/bag-2-white.svg') }}" class="w-6 h-6" alt="icon" />
                    <input
                        wire:model="email"
                        type="text"
                        name="email"
                        id="email"
                        class="w-full font-semibold py-[14px] md:py-[16px] outline-none placeholder:font-normal placeholder:text-[#878785]"
                        placeholder="Type your email address"
                    />
                </div>
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <hr class="border-[#EAEAED]" />

            {{--  quantity --}}
            <div class="flex flex-col gap-2">
                <p class="font-semibold">Quantity</p>
                <div class="relative flex items-center gap-[30px] md:gap-[40px]">
                    <button type="button" wire:click="decrementQuantity" class="w-full h-[54px] md:h-[60px] bg-[#2A2A2A] text-white font-bold text-xl md:text-2xl rounded-full flex justify-center items-center">
                        -
                    </button>
                    <p id="quantity-display" wire:model.live.debounce.500ms="quantity" class="font-bold text-xl md:text-2xl">{{ $quantity }}</p>
                    <input type="number" wire:model.live.debounce.500ms="quantity" id="quantity" name="quantity" value="1" class="sr-only -z-10" />
                    <button type="button" wire:click="incrementQuantity" class="w-full h-[54px] md:h-[60px] bg-[#C5F277] text-black font-bold text-xl md:text-2xl rounded-full flex justify-center items-center">
                        +
                    </button>
                </div>
            </div>

            {{-- Promo Code --}}
            <div class="flex flex-col gap-2">
                <label for="promo" class="font-semibold">Promo Code</label>
                <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] gap-[10px] transition-all focus-within:ring-2 focus-within:ring-[#FFC700]">
                    <img src="{{ asset('assets/images/icons/discount-shape.svg') }}" class="w-6 h-6" alt="icon" />
                    <input
                        wire:model.debounce.500ms="promoCode"
                        type="text"
                        name="promo"
                        id="promo"
                        class="w-full font-semibold py-[14px] md:py-[16px] outline-none placeholder:font-normal placeholder:text-[#878785]"
                        placeholder="Input the promo code"
                    />
                </div>
                @if (session()->has('message'))
                    <span class="text-sm font-semibold text-[#01A625]">Yeay! anda mendapatkan promo spesial</span>
                @endif
                @if (session()->has('error'))
                    <span class="text-sm font-semibold text-[#FF1943]">Sorry, kode promo tersebut tidak tersedia</span>
                @endif
            </div>

            <hr class="border-[#EAEAED]" />

            {{-- Total --}}
            <div class="flex items-center justify-between">
                <p class="font-semibold">Sub Total</p>
                <p id="total-price" class="font-bold">Rp {{ number_format($subTotalAmount, 0, ',', '.') }}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="font-semibold">Discount</p>
                <p id="discount" class="font-bold text-[#FF1943]">- Rp {{ number_format($discount, 0, ',', '.') }}</p>
            </div>
        </div>

        {{-- Bottom Nav --}}
        <div id="bottom-nav" class="relative flex h-[100px] w-full shrink-0 mt-5">
            <div class="fixed bottom-5 w-full max-w-[1200px] z-30 px-4">
                <div class="flex items-center justify-between rounded-full bg-[#2A2A2A] p-[10px] pl-6 md:px-8">
                    <div class="flex flex-col gap-[2px]">
                        <p id="grand-total" class="font-bold text-[20px] md:text-[24px] text-white">Rp {{ number_format($grandTotalAmount, 0, ',', '.') }}</p>
                        <p class="text-sm md:text-base text-[#878785]">Grand total</p>
                    </div>
                    <button class="rounded-full p-[12px_20px] md:p-[14px_24px] bg-[#C5F277] font-bold md:text-lg">
                        Continue
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
