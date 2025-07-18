<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sepatu Store BWA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center py-8">
    <div class="w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <a href="{{ route('front.index') }}" class="inline-block mb-4">
                <img src="{{ asset('assets/images/logos/logo.svg') }}" alt="Logo" class="h-12">
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Create Account</h1>
            <p class="text-gray-600 mt-2">Join our community today</p>
        </div>

        <!-- Register Form -->
        <div class="bg-white rounded-3xl shadow-lg p-8">
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-2xl">
                    <div class="text-red-600 text-sm">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <form action="{{ route('auth.register.post') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-[#FFC700] focus:border-transparent transition-all">
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-[#FFC700] focus:border-transparent transition-all">
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number (Optional)</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-[#FFC700] focus:border-transparent transition-all">
                </div>
                
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address (Optional)</label>
                    <textarea id="address" name="address" rows="3" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-[#FFC700] focus:border-transparent transition-all">{{ old('address') }}</textarea>
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" name="password" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-[#FFC700] focus:border-transparent transition-all">
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-[#FFC700] focus:border-transparent transition-all">
                </div>
                
                <button type="submit" 
                        class="w-full bg-[#C5F277] text-black font-bold py-3 rounded-2xl hover:bg-[#B5E267] transition-colors mt-6">
                    Create Account
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Already have an account? 
                    <a href="{{ route('auth.login') }}" class="text-[#FFC700] font-semibold hover:underline">
                        Sign in here
                    </a>
                </p>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="{{ route('front.index') }}" class="text-sm text-gray-500 hover:text-gray-700">
                ← Back to Home
            </a>
        </div>
    </div>
</body>
</html> 