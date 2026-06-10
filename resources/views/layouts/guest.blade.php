<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'HireWorld') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>body { font-family: 'Instrument Sans', sans-serif; }</style>
    </head>
    <body class="bg-[#080E1A] text-white antialiased min-h-screen flex flex-col">

        {{-- Navbar --}}
        <nav class="bg-[#080E1A] border-b border-white/10 px-6 sm:px-10 py-4 flex items-center justify-between">
            <a href="/" class="font-semibold text-white text-base">HireWorld</a>
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="text-sm text-white/60 hover:text-white transition">Entrar</a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-sm bg-white text-[#080E1A] font-semibold px-4 py-2 rounded-lg hover:bg-white/90 transition">Começar</a>
                @endif
            </div>
        </nav>

        {{-- Content --}}
        <div class="flex-1 flex items-center justify-center px-4 py-16">
            <div class="w-full max-w-md">
                <div class="bg-white/5 border border-white/10 rounded-2xl px-8 py-10 shadow-xl">
                    {{ $slot }}
                </div>
            </div>
        </div>

    </body>
</html>
