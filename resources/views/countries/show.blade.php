<x-countries-layout :title="$country->name . ' — HireWorld'">
    <div class="max-w-4xl mx-auto">

        {{-- Top bar --}}
        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('countries.index') }}" class="text-sm text-white/50 hover:text-white transition">
                ← Voltar
            </a>
            <a href="{{ route('countries.pdf', $country->id) }}"
               class="bg-white text-[#080E1A] font-semibold text-sm px-4 py-2 rounded-lg hover:bg-white/90 transition">
                Baixar PDF
            </a>
        </div>

        {{-- Country header --}}
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 mb-5">
            <div class="flex items-center gap-4 mb-6">
                <span class="text-5xl leading-none">{{ $country->flag_emoji }}</span>
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ $country->name }}</h1>
                    <span class="text-sm text-white/40">{{ $country->iso_code }}</span>
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                <div class="bg-white/5 rounded-xl px-4 py-3">
                    <p class="text-white/40 text-xs mb-1">Região</p>
                    <p class="text-white text-sm font-medium">{{ $country->region ?? '—' }}</p>
                </div>
                <div class="bg-white/5 rounded-xl px-4 py-3">
                    <p class="text-white/40 text-xs mb-1">Idioma oficial</p>
                    <p class="text-white text-sm font-medium">{{ $country->official_language ?? '—' }}</p>
                </div>
                <div class="bg-white/5 rounded-xl px-4 py-3">
                    <p class="text-white/40 text-xs mb-1">Moeda</p>
                    <p class="text-white text-sm font-medium">{{ $country->currency_code ?? '—' }}</p>
                </div>
                <div class="bg-white/5 rounded-xl px-4 py-3">
                    <p class="text-white/40 text-xs mb-1">Fuso horário</p>
                    <p class="text-white text-sm font-medium">{{ $country->timezone ?? '—' }}</p>
                </div>
                <div class="bg-white/5 rounded-xl px-4 py-3">
                    <p class="text-white/40 text-xs mb-1">1 USD</p>
                    <p class="text-cyan-400 text-sm font-semibold">{{ $rates ?? '—' }} {{ $country->currency_code }}</p>
                </div>
            </div>
        </div>

        {{-- Insights Culturais --}}
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 mb-5">
            <h2 class="text-base font-semibold text-white mb-5">🌍 Cultura de Negócios</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-white/5 rounded-xl px-4 py-3">
                    <p class="text-white/40 text-xs mb-1">Etiqueta em reuniões</p>
                    <p class="text-white/80 text-sm">{{ $insights['business_etiquette'] ?? '—' }}</p>
                </div>
                <div class="bg-white/5 rounded-xl px-4 py-3">
                    <p class="text-white/40 text-xs mb-1">Estilo de decisão</p>
                    <p class="text-white/80 text-sm">{{ $insights['decision_making_style'] ?? '—' }}</p>
                </div>
                <div class="bg-white/5 rounded-xl px-4 py-3">
                    <p class="text-white/40 text-xs mb-1">Comunicação</p>
                    <p class="text-white/80 text-sm">{{ $insights['communication_style'] ?? '—' }}</p>
                </div>
                <div class="bg-white/5 rounded-xl px-4 py-3">
                    <p class="text-white/40 text-xs mb-1">O que evitar</p>
                    <p class="text-white/80 text-sm">{{ $insights['things_to_avoid'] ?? '—' }}</p>
                </div>
            </div>
            <p class="text-xs text-white/20 mt-4">⚠️ Conteúdo gerado por IA — use como guia, não como fonte definitiva.</p>
        </div>

        {{-- Grid: Feriados + Salários --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

            {{-- Feriados --}}
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
                <h2 class="text-base font-semibold text-white mb-4">📅 Feriados {{ now()->year }}</h2>
                <ul class="space-y-2">
                    @forelse($holidays as $holiday)
                        <li class="flex justify-between text-sm py-2 border-b border-white/5 last:border-0">
                            <span class="text-white/80">{{ $holiday['name'] }}</span>
                            <span class="text-white/40 shrink-0 ml-2">{{ \Carbon\Carbon::parse($holiday['date'])->format('d/m') }}</span>
                        </li>
                    @empty
                        <li class="text-sm text-white/30">Nenhum feriado encontrado.</li>
                    @endforelse
                </ul>
            </div>

            {{-- Salários Tech --}}
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
                <h2 class="text-base font-semibold text-white mb-4">💻 Salários Tech</h2>
                @if (is_array($techSalaries) && isset($techSalaries['salary']))
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-white/5">
                            <span class="text-white/50 text-sm">Média anual</span>
                            <span class="text-cyan-400 font-semibold text-sm">${{ number_format($techSalaries['salary']['average']) }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-white/5">
                            <span class="text-white/50 text-sm">Mediana anual</span>
                            <span class="text-white text-sm font-medium">${{ number_format($techSalaries['salary']['median']) }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-white/5">
                            <span class="text-white/50 text-sm">Mínimo</span>
                            <span class="text-white text-sm font-medium">${{ number_format($techSalaries['salary']['min']) }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-white/50 text-sm">Máximo</span>
                            <span class="text-white text-sm font-medium">${{ number_format($techSalaries['salary']['max']) }}</span>
                        </div>
                    </div>
                    <p class="text-xs text-white/20 mt-4">Fonte: Stack Overflow Survey {{ $techSalaries['survey_year'] ?? '' }}</p>
                @else
                    <p class="text-sm text-white/30">Sem dados de salários para este país.</p>
                @endif
            </div>

        </div>

    </div>
</x-countries-layout>
