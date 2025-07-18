<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{asset('output.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
    </head>
    <body>
        <div class="relative flex flex-col w-full max-w-[1200px] min-h-screen gap-5 mx-auto bg-[#F5F5F0]">
            <div id="top-bar" class="flex justify-between items-center px-4 mt-[30px]">
                <a href="{{ route('front.index') }}">
                    <img src="{{asset('assets/images/icons/back.svg')}}" class="w-10 h-10" alt="icon">
                </a>
                <p class="font-bold text-lg leading-[27px]">New Products</p>
                <div class="dummy-btn w-10"></div>
            </div>

            <section id="new-products" class="flex flex-col gap-4 px-4">
                <div class="flex flex-col gap-4">
                    @forelse ($shoes as $shoe)
                        <a href="{{route('front.details', $shoe->slug)}}">
                            <div class="flex items-center rounded-3xl p-[10px_16px_16px_10px] gap-[14px] bg-white transition-all duration-300 hover:ring-2 hover:ring-[#FFC700]">
                                <div class="w-20 h-20 flex shrink-0 rounded-2xl bg-[#D9D9D9] overflow-hidden">
                                    <img src="{{Storage::url($shoe->thumbnail)}}" class="w-full h-full object-cover" alt="thumbnail">
                                </div>
                                <div class="flex w-full items-center justify-between gap-[14px]">
                                    <div class="flex flex-col gap-[6px]">
                                        <h3 class="font-bold leading-[20px]">
                                            {{$shoe->name}}
                                        </h3>
                                        <p class="text-sm leading-[21px] text-[#878785]">
                                            {{$shoe->category->name}}
                                        </p>
                                        <p class="font-bold text-sm leading-[21px]">
                                            Rp {{number_format($shoe->price, 0,',', '.')}}
                                        </p>
                                    </div>
                                    <div class="flex flex-col gap-1 items-end shrink-0">
                                        <div class="flex">
                                            <img src="{{asset('assets/images/icons/Star 1.svg')}}" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                                            <img src="{{asset('assets/images/icons/Star 1.svg')}}" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                                            <img src="{{asset('assets/images/icons/Star 1.svg')}}" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                                            <img src="{{asset('assets/images/icons/Star 1.svg')}}" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                                            <img src="{{asset('assets/images/icons/Star 1.svg')}}" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                                        </div>
                                        <p class="font-semibold text-sm leading-[21px]">4.5</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-center text-gray-500">No new products found.</p>
                    @endforelse
                </div>

                @if($shoes->hasPages())
                    <div class="flex justify-center mt-4">
                        {{ $shoes->links() }}
                    </div>
                @endif
            </section>
        </div>
    </body>
</html>
