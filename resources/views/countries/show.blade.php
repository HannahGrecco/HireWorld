<x-countries-layout :title="$country->name">

    <div class="max-w-4xl mx-auto">

        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('countries.index') }}" class="bg-white/95 border border-white/60 text-slate-700 hover:text-slate-900 px-4 py-2 rounded-full text-sm shadow inline-block">
                ← Voltar
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('countries.pdf', $country->id) }}"
                class="bg-slate-900 text-white px-4 py-2 rounded-lg text-sm hover:bg-slate-800">
                    Baixar relatorio PDF
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-white/95 border border-white/60 text-slate-700 hover:text-slate-900 px-4 py-2 rounded-full text-sm shadow">
                        Sair
                    </button>
                </form>
            </div>
        </div>
        {{-- Header do país --}}
        <div class="bg-white/95 rounded-2xl shadow-xl border border-white/60 p-6 mb-6">
            <div class="flex items-center gap-4 mb-4">
                <span class="text-5xl leading-none">{{ $country->flag_emoji }}</span>
                <div class="ml-auto flex flex-col justify-center text-right">
                    <h1 class="text-2xl font-semibold text-slate-900">{{ $country->name }}</h1>
                    <span class="text-sm text-slate-400">{{ $country->iso_code }}</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 text-sm text-slate-600">
                <div>
                    <span class="font-medium text-slate-700">Regiao</span>
                    <p>{{ $country->region ?? '—' }}</p>
                </div>
                <div>
                    <span class="font-medium text-slate-700">Idioma oficial</span>
                    <p>{{ $country->official_language ?? '—' }}</p>
                </div>
                <div>
                    <span class="font-medium text-slate-700">Moeda</span>
                    <p>{{ $country->currency_code ?? '—' }}</p>
                </div>
                <div>
                    <span class="font-medium text-slate-700">Fuso horario</span>
                    <p>{{ $country->timezone ?? '—' }}</p>
                </div>
                <div>
                    <span class="font-medium text-slate-700">1 USD</span>
                    <p>{{ $rates }} {{ $country->currency_code }}</p>
                </div>
            </div>

        </div>
        <div class="bg-white/95 rounded-2xl shadow-lg border border-white/60 p-6 mb-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">🌍 Cultura de Negocios</h2>

            <div class="space-y-4 text-sm text-slate-600">
                <div>
                    <p class="font-medium text-slate-700">Etiqueta em reunioes</p>
                    <p>{{ $insights['business_etiquette'] ?? '—' }}</p>
                </div>
                <div>
                    <p class="font-medium text-slate-700">Estilo de decisao</p>
                    <p>{{ $insights['decision_making_style'] ?? '—' }}</p>
                </div>
                <div>
                    <p class="font-medium text-slate-700">Comunicacao</p>
                    <p>{{ $insights['communication_style'] ?? '—' }}</p>
                </div>
                <div>
                    <p class="font-medium text-slate-700">O que evitar</p>
                    <p>{{ $insights['things_to_avoid'] ?? '—' }}</p>
                </div>
            </div>

            <p class="text-xs text-slate-400 mt-4">⚠️ Conteudo gerado por IA — use como guia, nao como fonte definitiva.</p>
        </div>

        {{-- Feriados --}}
        <div class="bg-white/95 rounded-2xl shadow-lg border border-white/60 p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Feriados {{ now()->year }}</h2>

            <ul class="divide-y divide-gray-100">
                @forelse($holidays as $holiday)
                    <li class="py-3 flex justify-between text-sm">
                        <span class="text-slate-700">{{ $holiday['name'] }}</span>
                        <span class="text-slate-400">{{ \Carbon\Carbon::parse($holiday['date'])->format('d/m/Y') }}</span>
                    </li>
                @empty
                    <li class="py-3 text-sm text-slate-400">Nenhum feriado encontrado para este pais.</li>
                @endforelse
            </ul>
        </div>

    </div>

</x-countries-layout>

