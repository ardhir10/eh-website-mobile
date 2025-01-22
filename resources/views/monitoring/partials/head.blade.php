<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env('APP_NAME') ? env('APP_NAME') : 'Pandawa Shankara Group'}} </title>
    <link rel="icon" href="{{ asset('assets/logo/general-logo.png') }}">


    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @include('layouts.head')

    @stack('css')
    @stack('style')
    <style>
        [x-cloak] { 
            display: none !important; 
        }
        .swal2-popup {
            font-family: 'eh_sansreg-webfont', sans-serif;
            border-radius: 12px;
        }
        
        /* Tambahkan animasi untuk dots */
        @keyframes loadingDots {
            0% { content: '.'; }
            33% { content: '..'; }
            66% { content: '...'; }
            100% { content: ''; }
        }

        .dots::after {
            content: '';
            animation: loadingDots 2.1s infinite;
        }
    </style>

    {{-- Setup Font Open Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
    @stack('styles')