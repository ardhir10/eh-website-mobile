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
<body class="tw-bg-[#25293C] tw-flex tw-justify-center tw-items-center tw-h-screen">
    <div class="tw-w-full tw-max-w-sm tw-bg-[#2F3349] tw-rounded-lg tw-p-8 tw-shadow-lg">
        <div class="tw-mb-4 tw-text-center">
            <h2 class="tw-text-2xl tw-text-white tw-font-bold">Welcome! 👋</h2>
            <p class="tw-text-gray-300">Please sign-in to your account and start the adventure</p>
        </div>
        <form action="/login" method="POST" class="tw-space-y-6">
            @csrf
            <div>
                <label for="email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-300">Email or Username</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Email or Username"
                    required 
                    class="input"
                >
            </div>
            <div class="tw-relative">
                <label for="password" class="tw-block tw-text-sm tw-font-medium tw-text-gray-300">Password</label>
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
                    class="tw-absolute tw-top-0 tw-right-0 tw-pr-3 tw-flex tw-items-center tw-text-xs tw-text-blue-300 hover:tw-text-blue-400"
                >
                    Forgot Password?
                </a>
            </div>
            <div class="tw-flex tw-items-center tw-justify-between">
                <div class="tw-flex tw-items-center">
                    <input id="remember_me" name="remember_me" type="checkbox" class="checkbox">
                    <label for="remember_me" class="tw-ml-2 tw-block tw-text-sm tw-text-gray-300">Remember Me</label>
                </div>
            </div>
            <button 
                type="submit" 
                class="tw-w-full tw-flex tw-justify-center tw-py-2 tw-px-4 tw-border tw-border-transparent tw-rounded-md tw-shadow-sm tw-text-sm tw-font-medium tw-text-white tw-bg-[#7367F0] hover:tw-bg-[#7367F0]/80"
            >
                Sign in
            </button>
        </form>
        <div class="tw-mt-6 tw-text-center tw-text-sm tw-text-gray-300">
            New on our platform? <a href="#" class="tw-text-blue-300 hover:tw-text-blue-400 tw-font-bold">Create an account</a>
        </div>
        <div class="tw-mt-4 tw-flex tw-justify-center tw-gap-4">
            <a href="#" class="tw-text-blue-300"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="tw-text-blue-300"><i class="fab fa-google"></i></a>
            <a href="#" class="tw-text-blue-300"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
</body>
</html>
<!-- End of Selection -->