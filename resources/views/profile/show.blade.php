<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
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
                </a>
                <a href="{{ route('front.index') }}" class="text-gray-600 hover:text-gray-900">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 py-8">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl">
                <div class="text-green-600 text-sm">{{ session('success') }}</div>
            </div>
        @endif

        <!-- Profile Header -->
        <div class="bg-white rounded-3xl shadow-lg p-8 mb-8">
            <div class="flex items-center space-x-6">
                <div class="w-20 h-20 bg-[#C5F277] rounded-full flex items-center justify-center">
                    <span class="text-2xl font-bold text-black">{{ substr($customer->name, 0, 1) }}</span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $customer->name }}</h1>
                    <p class="text-gray-600">{{ $customer->email }}</p>
                    <p class="text-sm text-gray-500">Member sejak {{ $customer->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Profile Information -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Personal Information -->
            <div class="bg-white rounded-3xl shadow-lg p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Informasi Pribadi</h2>
                    <a href="{{ route('profile.edit') }}" class="text-[#FFC700] hover:text-[#E6B800] font-semibold">
                        Edit
                    </a>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <p class="text-gray-900">{{ $customer->name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <p class="text-gray-900">{{ $customer->email }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                        <p class="text-gray-900">{{ $customer->phone ?: 'Belum diisi' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <p class="text-gray-900">{{ $customer->address ?: 'Belum diisi' }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-3xl shadow-lg p-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Aksi Cepat</h2>
                
                <div class="space-y-4">
                    <a href="{{ route('profile.orders') }}" 
                       class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl hover:bg-gray-100 transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-[#C5F277] rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Riwayat Pesanan</p>
                                <p class="text-sm text-gray-600">Lihat semua pesanan Anda</p>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <a href="{{ route('front.index') }}" 
                       class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl hover:bg-gray-100 transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-[#FFC700] rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Belanja Lagi</p>
                                <p class="text-sm text-gray-600">Temukan produk terbaru</p>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <form action="{{ route('auth.logout') }}" method="POST" class="pt-4">
                        @csrf
                        <button type="submit" 
                                class="w-full flex items-center justify-center space-x-3 p-4 bg-red-50 text-red-600 rounded-2xl hover:bg-red-100 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="font-semibold">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 