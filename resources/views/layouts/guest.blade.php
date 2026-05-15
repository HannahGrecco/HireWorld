<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="background-image: linear-gradient(160deg, rgba(15, 23, 42, 0.82), rgba(2, 6, 23, 0.6)), url('/landingBg.jpg')" class="font-sans text-slate-900 antialiased bg-cover bg-center">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-10 sm:pt-0 relative">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(59,130,246,0.2),transparent_45%),radial-gradient(circle_at_80%_10%,rgba(16,185,129,0.25),transparent_40%),radial-gradient(circle_at_50%_80%,rgba(253,186,116,0.2),transparent_45%)] pointer-events-none"></div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white/95 shadow-xl overflow-hidden rounded-2xl border border-white/60 relative">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
