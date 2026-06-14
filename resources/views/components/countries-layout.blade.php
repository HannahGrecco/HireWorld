<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'HireWorld' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Instrument Sans', sans-serif; }</style>
</head>
<body class="bg-[#080E1A] text-white min-h-screen flex flex-col">

    {{-- NAVBAR --}}
    <nav class="bg-[#080E1A] border-b border-white/10 px-6 sm:px-10 py-4 flex items-center justify-between">
        <a href="/" class="font-semibold text-white text-base">HireWorld</a>
        <div class="flex items-center gap-4">
            <a href="{{ route('countries.index') }}" class="text-sm text-white/60 hover:text-white transition">Países</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-white/60 hover:text-white transition">Sair</button>
            </form>
        </div>
    </nav>

    {{-- CONTENT --}}
    <main class="flex-1 px-6 sm:px-10 py-10">
        {{ $slot }}
    </main>

</body>
</html>
