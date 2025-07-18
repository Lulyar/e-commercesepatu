<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Sepatu Store BWA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-4xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('front.index') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('assets/images/logos/logo.svg') }}" alt="Logo" class="h-8">
                    <span class="font-bold text-lg">Sepatu Store BWA</span>
                </a>
                <a href="{{ route('profile.show') }}" class="text-gray-600 hover:text-gray-900">
                    ← Kembali ke Profil
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">Riwayat Pesanan</h1>

        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white rounded-3xl shadow-lg p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="font-bold text-lg text-gray-900">{{ $order->shoe->name }}</h3>
                                <p class="text-sm text-gray-600">Order ID: {{ $order->booking_trx_id }}</p>
                                <p class="text-sm text-gray-600">{{ $order->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                                    {{ $order->is_paid ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $order->is_paid ? 'Lunas' : 'Menunggu Pembayaran' }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div class="flex items-center space-x-3">
                                <img src="{{ Storage::url($order->shoe->thumbnail) }}" 
                                     alt="{{ $order->shoe->name }}" 
                                     class="w-16 h-16 rounded-2xl object-cover">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $order->shoe->brand->name }}</p>
                                    <p class="text-sm text-gray-600">Ukuran: {{ $order->shoeSize->size }}</p>
                                    <p class="text-sm text-gray-600">Qty: {{ $order->quantity }}</p>
                                </div>
                            </div>
                            
                            <div class="text-right">
                                <p class="text-sm text-gray-600">Sub Total</p>
                                <p class="font-bold text-lg text-gray-900">Rp {{ number_format($order->sub_total_amount, 0, ',', '.') }}</p>
                                @if($order->discount_amount > 0)
                                    <p class="text-sm text-green-600">Diskon: -Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</p>
                                @endif
                                <p class="text-sm text-gray-600">Total</p>
                                <p class="font-bold text-xl text-[#FFC700]">Rp {{ number_format($order->grand_total_amount, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p class="font-medium text-gray-700">Alamat Pengiriman</p>
                                    <p class="text-gray-600">{{ $order->address }}</p>
                                    <p class="text-gray-600">{{ $order->city }}, {{ $order->post_code }}</p>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-700">Kontak</p>
                                    <p class="text-gray-600">{{ $order->phone }}</p>
                                    <p class="text-gray-600">{{ $order->email }}</p>
                                </div>
                            </div>
                        </div>

                        @if(!$order->is_paid)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <a href="{{ route('order.finished', $order->booking_trx_id) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-[#C5F277] text-black font-semibold rounded-2xl hover:bg-[#B5E267] transition-colors">
                                    Lihat Detail Pembayaran
                                </a>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($orders->hasPages())
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @endif
        @else
            <div class="bg-white rounded-3xl shadow-lg p-8 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Pesanan</h3>
                <p class="text-gray-600 mb-6">Anda belum memiliki riwayat pesanan. Mulai belanja sekarang!</p>
                <a href="{{ route('front.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-[#C5F277] text-black font-semibold rounded-2xl hover:bg-[#B5E267] transition-colors">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>
</body>
</html> 