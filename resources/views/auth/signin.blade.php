<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pandawa Shankara Group &mdash; Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Iceland&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM6g0g5z5e5e5e5e5e5e5e5e5e5e5e5e5e5e5e" crossorigin="anonymous">
</head>
<body class="bg-white min-h-screen py-12 px-4 sm:px-6 lg:px-8 font-['Open_Sans']">
    <!-- Updated navbar with centered logo -->
    <nav class="fixed top-0 left-0 right-0 bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center h-16">
                <img src="{{ asset('assets/logo/logo-eh-2.png') }}" alt="Logo" class="h-12 object-contain my-2">
            </div>
        </div>
    </nav>

    <div class="w-full max-w-md mx-auto space-y-8 mt-16">
        <div class="text-center flex flex-col items-center gap-1">
            <h2 class="text-2xl text-gray-800">Site Monitoring</h2>
            <p class="mt-2 text-gray-600">Log In to your account</p>
        </div>
        
        <form action="{{ url('auth/signin') }}" method="POST" class="mt-8 space-y-6">
            @csrf
            <div>
                <label for="login" class="block text-sm font-medium text-gray-700">Email or Username</label>
                <input 
                    type="text" 
                    id="login" 
                    name="login" 
                    placeholder="Email or Username"
                    class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 @error('login') border-red-500 @enderror"
                    value="{{ old('login') }}"
                >
                @error('login')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="relative">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password"
                    placeholder="Password"
                    class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 @error('password') border-red-500 @enderror"
                >
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input 
                        id="remember_me" 
                        name="remember_me" 
                        type="checkbox" 
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                    >
                    <label for="remember_me" class="ml-2 block text-sm text-gray-600">Remember Me</label>
                </div>
              </div>

            <button 
                type="submit" 
                class="w-full flex justify-center py-3 px-4 rounded-lg text-sm font-semibold text-white bg-[#A8005C] hover:bg-[#8a004d] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#A8005C] transition duration-150"
            >
                Sign in
            </button>
        </form>
        
        <!-- Added footer -->
        <footer class="fixed bottom-0 left-0 right-0 bg-white py-4">
            <div class="text-center text-sm text-gray-600">
                &copy; {{ date('Y') }} Pandawa Shankara Group. All rights reserved.
            </div>
        </footer>
    </div>
</body>
</html>
<!-- End of Selection -->