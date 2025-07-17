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
            <a href="{{ route('front.booking') }}">
                <img src="{{ asset('assets/images/icons/back.svg') }}" class="w-10 h-10 md:w-12 md:h-12" alt="icon">
            </a>
            <p class="font-bold text-lg md:text-xl leading-[27px]">Delivery</p>
            <div class="dummy-btn w-10 md:w-12"></div>
        </div>

        <div class="flex items-center rounded-3xl gap-[14px] p-[10px_16px_16px_10px] mx-4 md:mx-8">
            <div class="flex shrink-0 w-20 h-20 md:w-24 md:h-24 rounded-2xl p-1 overflow-hidden">
                <img src="{{ Storage::url($shoe->photos()->latest()->first()->photo) }}" class="w-full h-full object-contain" alt="">
            </div>
            <div class="flex flex-col w-full">
                <h1 id="title" class="font-bold text-lg md:text-xl leading-6">
                    {{ $shoe->name }}
                </h1>
                <p class="font-semibold text-sm md:text-base leading-[21px]">
                    {{ $orderData['shoe_size'] ?? 'Size not selected' }} • {{ $orderData['quantity'] ?? 1 }} Pcs
                </p>
            </div>
            <div class="flex items-center shrink-0 gap-1">
                <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-[22px] h-[22px] md:w-6 md:h-6" alt="star">
                <span class="font-semibold text-sm md:text-base leading-[21px]">4.5</span>
            </div>
        </div>

        <form action="{{ route('front.save_customer_data') }}" method="POST" class="flex flex-col gap-5">
            @csrf
            <div class="flex flex-col rounded-[20px] p-4 md:p-6 mx-4 md:mx-8 pb-5 gap-5 bg-white">
                <h1 class="font-bold text-[22px] md:text-[26px]">Shipping Address</h1>
                <hr class="border-[#EAEAED]">

                <div class="flex flex-col gap-2">
                    <label for="name" class="font-semibold md:text-lg">Name</label>
                    <input type="text" name="name" id="name"
                        class="appearance-none outline-none w-full font-semibold placeholder:text-[#878785] py-[14px] md:py-[16px] rounded-full ring-1 ring-[#090917] px-4 md:px-6 text-base md:text-lg"
                        placeholder="Your full name" required>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="email" class="font-semibold md:text-lg">Email</label>
                    <input type="email" name="email" id="email"
                        class="appearance-none outline-none w-full font-semibold placeholder:text-[#878785] py-[14px] md:py-[16px] rounded-full ring-1 ring-[#090917] px-4 md:px-6 text-base md:text-lg"
                        placeholder="Your email address" required>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="address" class="font-semibold md:text-lg">Full Address</label>
                    <div class="flex items-start w-full rounded-[18px] ring-1 ring-[#090917] p-[14px] md:p-[16px] gap-[10px] focus-within:ring-2 focus-within:ring-[#FFC700]">
                        <img src="{{ asset('assets/images/icons/house-2.svg') }}" class="w-6 h-6 md:w-7 md:h-7 flex shrink-0" alt="icon">
                        <textarea name="address" id="address" rows="4" required
                            class="appearance-none outline-none w-full font-semibold placeholder:text-[#878785] text-base md:text-lg"
                            placeholder="Type your full address"></textarea>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="phone" class="font-semibold md:text-lg">Phone Number</label>
                    <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] md:px-[16px] gap-[10px] focus-within:ring-2 focus-within:ring-[#FFC700]">
                        <img src="{{ asset('assets/images/icons/call.svg') }}" class="w-6 h-6 md:w-7 md:h-7 flex shrink-0" alt="icon">
                        <input type="tel" name="phone" id="phone"
                            class="appearance-none outline-none w-full font-semibold placeholder:text-[#878785] py-[14px] md:py-[16px] text-base md:text-lg"
                            placeholder="What's your phone number" required>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="province" class="font-semibold md:text-lg">Province</label>
                    <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] md:px-[16px] gap-[10px] focus-within:ring-2 focus-within:ring-[#FFC700]">
                        <img src="{{ asset('assets/images/icons/global.svg') }}" class="w-6 h-6 md:w-7 md:h-7 flex shrink-0" alt="icon">
                        <select name="province" id="province" 
                            class="appearance-none outline-none w-full font-semibold py-[14px] md:py-[16px] text-base md:text-lg bg-transparent"
                            required>
                            <option value="">Select Province</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province['province_id'] }}">{{ $province['province'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="city" class="font-semibold md:text-lg">City</label>
                    <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] md:px-[16px] gap-[10px] focus-within:ring-2 focus-within:ring-[#FFC700]">
                        <img src="{{ asset('assets/images/icons/global.svg') }}" class="w-6 h-6 md:w-7 md:h-7 flex shrink-0" alt="icon">
                        <select name="city" id="city" 
                            class="appearance-none outline-none w-full font-semibold py-[14px] md:py-[16px] text-base md:text-lg bg-transparent"
                            required disabled>
                            <option value="">Select City</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="post_code" class="font-semibold md:text-lg">Post Code</label>
                    <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] md:px-[16px] gap-[10px] focus-within:ring-2 focus-within:ring-[#FFC700]">
                        <img src="{{ asset('assets/images/icons/location.svg') }}" class="w-6 h-6 md:w-7 md:h-7 flex shrink-0" alt="icon">
                        <select name="post_code" id="post_code" 
                            class="appearance-none outline-none w-full font-semibold py-[14px] md:py-[16px] text-base md:text-lg bg-transparent"
                            required disabled>
                            <option value="">Select Post Code</option>
                        </select>
                    </div>
                </div>

                <hr class="border-[#EAEAED]">
                <div class="flex items-center gap-[10px]">
                    <img src="{{ asset('assets/images/icons/shield-tick.svg') }}" class="w-8 h-8 md:w-10 md:h-10 flex shrink-0" alt="icon">
                    <p class="leading-[26px] md:text-lg md:leading-[28px]">Kami melindungi data privasi anda dengan baik bantuan Angga X.</p>
                </div>
            </div>

            <div id="bottom-nav" class="relative flex h-[100px] w-full shrink-0 mt-5">
                <div class="fixed bottom-5 w-full max-w-[1200px] z-30 px-4">
                    <div class="flex items-center justify-between rounded-full bg-[#2A2A2A] p-[10px] pl-6 md:px-8">
                        <div class="flex flex-col gap-[2px]">
                            <p id="grand-total" class="font-bold text-[20px] md:text-[24px] leading-[30px] text-white">
                                Rp {{ number_format($orderData['grand_total_amount'] ?? 0, 0, ',', '.') }}
                            </p>
                            <p class="text-sm md:text-base leading-[21px] text-[#878785]">Grand total</p>
                        </div>
                        <button type="submit" class="rounded-full p-[12px_20px] md:p-[14px_24px] bg-[#C5F277] font-bold md:text-lg">
                            Continue
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const provinceSelect = document.getElementById('province');
            const citySelect = document.getElementById('city');
            const postCodeSelect = document.getElementById('post_code');

            // Handle province change
            provinceSelect.addEventListener('change', function() {
                const provinceId = this.value;
                
                // Reset city and post code
                citySelect.innerHTML = '<option value="">Select City</option>';
                postCodeSelect.innerHTML = '<option value="">Select Post Code</option>';
                citySelect.disabled = true;
                postCodeSelect.disabled = true;

                if (provinceId) {
                    // Fetch cities for selected province
                    fetch(`/api/cities?province_id=${provinceId}`)
                        .then(response => response.json())
                        .then(cities => {
                            citySelect.disabled = false;
                            cities.forEach(city => {
                                const option = document.createElement('option');
                                option.value = city.city_id;
                                option.textContent = `${city.type} ${city.city_name}`;
                                citySelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching cities:', error);
                        });
                }
            });

            // Handle city change
            citySelect.addEventListener('change', function() {
                const cityId = this.value;
                
                // Reset post code
                postCodeSelect.innerHTML = '<option value="">Select Post Code</option>';
                postCodeSelect.disabled = true;

                if (cityId) {
                    // Fetch postal codes for selected city
                    fetch(`/api/postal-codes?city_id=${cityId}`)
                        .then(response => response.json())
                        .then(postalCodes => {
                            postCodeSelect.disabled = false;
                            postalCodes.forEach(code => {
                                const option = document.createElement('option');
                                option.value = code;
                                option.textContent = code;
                                postCodeSelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching postal codes:', error);
                        });
                }
            });

            // Add search functionality for cities (optional)
            const citySearchInput = document.createElement('input');
            citySearchInput.type = 'text';
            citySearchInput.placeholder = 'Search cities...';
            citySearchInput.className = 'w-full p-2 border rounded-lg mb-2';
            citySearchInput.style.display = 'none';
            
            citySelect.parentNode.insertBefore(citySearchInput, citySelect);

            citySearchInput.addEventListener('input', function() {
                const keyword = this.value;
                if (keyword.length > 2) {
                    fetch(`/api/cities/search?keyword=${encodeURIComponent(keyword)}`)
                        .then(response => response.json())
                        .then(cities => {
                            citySelect.innerHTML = '<option value="">Select City</option>';
                            cities.forEach(city => {
                                const option = document.createElement('option');
                                option.value = city.city_id;
                                option.textContent = `${city.type} ${city.city_name}, ${city.province}`;
                                citySelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error searching cities:', error);
                        });
                }
            });
        });
    </script>
</body>
</html>
