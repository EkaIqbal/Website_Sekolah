<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Meta dan lainnya -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/logo/sd1.png') }}">


    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.0/css/all.min.css">

    <!-- Tailwind & Flowbite via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-dYhBz4RgKkn6U4wN89bNVkp9YH2uENpzwfLQHmvW4Wc4HfzNAm7e7E5l2+fFOZ6OlVURuOEZ1RRPM8Gb5Pu5Kg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="font-sans antialiased bg-gray-100 text-gray-900 dark:bg-white dark:text-white">

    <!--@include('components.header')-->

    @include('components.navbar')

    <!-- Header jika ada -->
    @if (isset($header))
      <!--  <header class="bg-blue-900 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-Main content -->
    <main class="min-h-screen bg-white">
        {{ $slot }}
    </main>

    @include('components.footer')

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
    AOS.init({
        duration: 800, // durasi animasi dalam ms
        once: true     // animasi hanya muncul sekali saat pertama scroll
    });
    </script>
    
</body>
</html>
