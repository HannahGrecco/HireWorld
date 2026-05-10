<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $country->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen p-8">

    <div class="max-w-3xl mx-auto">

        {{-- Voltar --}}
        <a href="{{ route('countries.index') }}" class="text-sm text-gray-500 hover:text-gray-700 mb-6 inline-block">
            ← Voltar
        </a>

        {{-- Header do país --}}
        <div class="bg-white rounded-2xl shadow p-6 mb-6">
            <div class="flex items-center gap-4 mb-4">
                <span class="text-5xl">{{ $country->flag_emoji }}</span>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800">{{ $country->name }}</h1>
                    <span class="text-sm text-gray-400">{{ $country->iso_code }}</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                <div>
                    <span class="font-medium text-gray-700">Região</span>
                    <p>{{ $country->region ?? '—' }}</p>
                </div>
                <div>
                    <span class="font-medium text-gray-700">Idioma oficial</span>
                    <p>{{ $country->official_language ?? '—' }}</p>
                </div>
                <div>
                    <span class="font-medium text-gray-700">Moeda</span>
                    <p>{{ $country->currency_code ?? '—' }}</p>
                </div>
                <div>
                    <span class="font-medium text-gray-700">Fuso horário</span>
                    <p>{{ $country->timezone ?? '—' }}</p>
                </div>
            </div>
        </div>

        {{-- Feriados --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Feriados {{ now()->year }}</h2>

            @if(empty($holidays))
                <p class="text-sm text-gray-400">Nenhum feriado encontrado para este país.</p>
            @else
                <ul class="divide-y divide-gray-100">
                    @foreach($holidays as $holiday)
                        <li class="py-3 flex justify-between text-sm">
                            <span class="text-gray-700">{{ $holiday['name'] }}</span>
                            <span class="text-gray-400">{{ \Carbon\Carbon::parse($holiday['date'])->format('d/m/Y') }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>

</body>
</html>
