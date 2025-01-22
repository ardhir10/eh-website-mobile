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
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM6g0g5z5e5e5e5e5e5e5e5e5e5e5e5e5e5e5e" crossorigin="anonymous">
</head>
<body class="bg-[#25293C] flex justify-center items-center h-screen">
    <div class="w-full max-w-sm bg-[#2F3349] rounded-lg p-8 shadow-lg">
        <div class="mb-4 text-center">
            <h2 class="text-2xl text-white font-bold">Welcome! 👋</h2>
            <p class="text-gray-300">Please sign-in to your account and start the adventure</p>
        </div>
        <form action="/login" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300">Email or Username</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Email or Username"
                    required 
                    class="input"
                >
            </div>
            <div class="relative">
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password"
                    placeholder="Password"
                    required 
                    class="input"
                >
                <a 
                    href="#" 
                    class="absolute top-0 right-0 pr-3 flex items-center text-xs text-blue-300 hover:text-blue-400"
                >
                    Forgot Password?
                </a>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember_me" type="checkbox" class="checkbox">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-300">Remember Me</label>
                </div>
            </div>
            <button 
                type="submit" 
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#7367F0] hover:bg-[#7367F0]/80"
            >
                Sign in
            </button>
        </form>
        <div class="mt-6 text-center text-sm text-gray-300">
            New on our platform? <a href="#" class="text-blue-300 hover:text-blue-400 font-bold">Create an account</a>
        </div>
        <div class="mt-4 flex justify-center gap-4">
            <a href="#" class="text-blue-300"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-blue-300"><i class="fab fa-google"></i></a>
            <a href="#" class="text-blue-300"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
</body>
</html>
<!-- End of Selection -->