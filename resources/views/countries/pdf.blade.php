<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; color: #333; margin: 40px; }
        h1 { font-size: 24px; margin-bottom: 4px; }
        h2 { font-size: 16px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin-top: 24px; }
        .subtitle { font-size: 12px; color: #888; margin-bottom: 24px; }
        .grid { display: flex; gap: 24px; margin-bottom: 8px; }
        .label { font-weight: bold; width: 160px; flex-shrink: 0; }
        .holiday-row { display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px solid #f0f0f0; }
        .insight-block { margin-bottom: 14px; }
        .insight-label { font-weight: bold; margin-bottom: 4px; }
        .disclaimer { font-size: 11px; color: #aaa; margin-top: 32px; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>

    <h1>{{ $country->name }}</h1>
    <p class="subtitle">Relatório gerado pelo HireWorld</p>

    <h2>Dados Gerais</h2>
    <div class="grid"><span class="label">Região</span><span>{{ $country->region ?? '—' }}</span></div>
    <div class="grid"><span class="label">Idioma oficial</span><span>{{ $country->official_language ?? '—' }}</span></div>
    <div class="grid"><span class="label">Moeda</span><span>{{ $country->currency_code ?? '—' }}</span></div>
    <div class="grid"><span class="label">Fuso horário</span><span>{{ $country->timezone ?? '—' }}</span></div>
    <div class="grid"><span class="label">Câmbio</span><span>1 USD = {{ $rates }} {{ $country->currency_code }}</span></div>

    <h2>Feriados {{ now()->year }}</h2>
    @forelse($holidays as $holiday)
        <div class="holiday-row">
            <span>{{ $holiday['name'] }}</span>
            <span>{{ \Carbon\Carbon::parse($holiday['date'])->format('d/m/Y') }}</span>
        </div>
    @empty
        <p>Nenhum feriado encontrado.</p>
    @endforelse

    <h2>Cultura de Negócios</h2>
    @if($insights)
        <div class="insight-block">
            <p class="insight-label">Etiqueta em reuniões</p>
            <p>{{ $insights['business_etiquette'] ?? '—' }}</p>
        </div>
        <div class="insight-block">
            <p class="insight-label">Estilo de decisão</p>
            <p>{{ $insights['decision_making_style'] ?? '—' }}</p>
        </div>
        <div class="insight-block">
            <p class="insight-label">Comunicação</p>
            <p>{{ $insights['communication_style'] ?? '—' }}</p>
        </div>
        <div class="insight-block">
            <p class="insight-label">O que evitar</p>
            <p>{{ $insights['things_to_avoid'] ?? '—' }}</p>
        </div>
    @endif

    <p class="disclaimer">Conteúdo cultural gerado por IA — use como guia, não como fonte definitiva.</p>

</body>
</html>
