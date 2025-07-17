<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - Sepatu Store BWA</title>
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

    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="bg-white rounded-3xl shadow-lg p-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-8">Edit Profil</h1>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl">
                    <div class="text-red-600 text-sm">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $customer->name) }}" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-[#FFC700] focus:border-transparent transition-all">
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $customer->email) }}" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-[#FFC700] focus:border-transparent transition-all">
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-[#FFC700] focus:border-transparent transition-all">
                </div>
                
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                    <textarea id="address" name="address" rows="4" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-[#FFC700] focus:border-transparent transition-all">{{ old('address', $customer->address) }}</textarea>
                </div>
                
                <div class="flex space-x-4 pt-4">
                    <button type="submit" 
                            class="flex-1 bg-[#C5F277] text-black font-bold py-3 rounded-2xl hover:bg-[#B5E267] transition-colors">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('profile.show') }}" 
                       class="flex-1 bg-gray-100 text-gray-700 font-bold py-3 rounded-2xl hover:bg-gray-200 transition-colors text-center">
                        Batal
                    </a>
                </div>
            </form>

            <!-- Change Password Section -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Ubah Password</h2>
                
                <form action="{{ route('profile.change-password') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                        <input type="password" id="current_password" name="current_password" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-[#FFC700] focus:border-transparent transition-all">
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                        <input type="password" id="password" name="password" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-[#FFC700] focus:border-transparent transition-all">
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-[#FFC700] focus:border-transparent transition-all">
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-[#FFC700] text-black font-bold py-3 rounded-2xl hover:bg-[#E6B800] transition-colors">
                        Ubah Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 