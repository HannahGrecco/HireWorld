<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'HireWorld' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background-image: linear-gradient(160deg, rgba(15, 23, 42, 0.82), rgba(2, 6, 23, 0.6)), url('/landingBg.jpg')" class="bg-im text-[#0f172a] min-h-screen bg-cover bg-center relative">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(59,130,246,0.2),transparent_45%),radial-gradient(circle_at_80%_10%,rgba(16,185,129,0.25),transparent_40%),radial-gradient(circle_at_50%_80%,rgba(253,186,116,0.2),transparent_45%)] pointer-events-none z-0"></div>
    <div class="relative z-10 min-h-screen p-6 lg:p-8">
        {{ $slot }}
    </div>
</body>
</html>
