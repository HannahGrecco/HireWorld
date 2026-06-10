<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HireWorld</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Instrument Sans', sans-serif; }</style>
</head>
<body class="bg-[#080E1A] text-white">

    {{-- NAVBAR --}}
    <nav class="bg-[#080E1A] border-b border-white/10 px-6 sm:px-10 py-4 flex items-center justify-between">
        <div class="flex items-center gap-8">
            <a href="/" class="font-semibold text-white text-base">HireWorld</a>
            <a href="#funcionalidades" class="text-white/60 text-sm hover:text-white transition">Recursos</a>
        </div>
        <div class="flex items-center gap-4">
            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="text-sm text-white/70 hover:text-white transition">Entrar</a>
            @endif
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="text-sm bg-white text-[#080E1A] font-semibold px-4 py-2 rounded-lg hover:bg-white/90 transition">Começar</a>
            @endif
        </div>
    </nav>

    {{-- HERO --}}
    <section class="bg-[#080E1A] min-h-[90vh] flex items-center px-6 sm:px-10 py-20">
        <div class="max-w-6xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Left: copy --}}
            <div>
                <span class="inline-block text-xs font-semibold tracking-widest uppercase text-cyan-400 mb-4">
                    Inteligência para contratação global
                </span>
                <h1 class="text-4xl sm:text-6xl font-bold text-white leading-tight mb-6">
                    Contrate além das fronteiras com clareza
                </h1>
                <p class="text-white/60 text-lg leading-relaxed mb-8">
                    Feriados, salários, câmbio e cultura local — tudo que você precisa antes de fechar uma contratação internacional.
                </p>
                <div class="flex items-center gap-4">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-white text-[#080E1A] font-semibold px-6 py-3 rounded-lg hover:bg-white/90 transition">
                            Começar agora
                        </a>
                    @endif
                    <a href="#funcionalidades" class="text-white/70 hover:text-white text-sm transition flex items-center gap-1">
                        Ver recursos →
                    </a>
                </div>
            </div>

            {{-- Right: live data cards --}}
            <div class="flex flex-col gap-3">
                <div class="flex items-center justify-between bg-white/5 border border-white/10 rounded-xl px-5 py-4">
                    <div>
                        <p class="text-white font-medium">🇩🇪 Alemanha</p>
                        <p class="text-white/40 text-xs mt-0.5">Senior Dev</p>
                    </div>
                    <span class="text-cyan-400 font-semibold">€78k / ano</span>
                </div>
                <div class="flex items-center justify-between bg-white/5 border border-white/10 rounded-xl px-5 py-4">
                    <div>
                        <p class="text-white font-medium">🇨🇦 Canadá</p>
                        <p class="text-white/40 text-xs mt-0.5">próx. feriado</p>
                    </div>
                    <span class="text-cyan-400 font-semibold">2 jul</span>
                </div>
                <div class="flex items-center justify-between bg-white/5 border border-white/10 rounded-xl px-5 py-4">
                    <div>
                        <p class="text-white font-medium">🇯🇵 Japão</p>
                        <p class="text-white/40 text-xs mt-0.5">USD → JPY</p>
                    </div>
                    <span class="text-cyan-400 font-semibold">149.2</span>
                </div>
                <div class="flex items-center justify-between bg-white/5 border border-white/10 rounded-xl px-5 py-4">
                    <div>
                        <p class="text-white font-medium">🇧🇷 Brasil</p>
                        <p class="text-white/40 text-xs mt-0.5">cultura</p>
                    </div>
                    <span class="text-cyan-400 font-semibold text-sm">ver insights →</span>
                </div>
            </div>

        </div>
    </section>


    {{-- FUNCIONALIDADES --}}
    <section id="funcionalidades" class="bg-white px-6 sm:px-10 py-24">
        <div class="max-w-5xl mx-auto">
            <p class="text-cyan-600 text-xs font-semibold tracking-widest uppercase mb-3">Funcionalidades</p>
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">Tudo que impacta uma contratação global</h2>
            <p class="text-slate-500 text-base mb-14 max-w-xl">Dados reais, fontes confiáveis e insights de IA — reunidos num só lugar.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                {{-- Feriados --}}
                <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:border-cyan-400 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-cyan-50 rounded-lg flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </div>
                    <h3 class="text-slate-900 font-semibold mb-2">Feriados nacionais</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-4">Calendário completo por país, integrado à sua timeline de projeto.</p>
                    <span class="text-xs text-slate-400 font-medium">Nager.Date</span>
                </div>

                {{-- Câmbio --}}
                <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:border-cyan-400 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-cyan-50 rounded-lg flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <line x1="12" y1="1" x2="12" y2="23"/>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                        </svg>
                    </div>
                    <h3 class="text-slate-900 font-semibold mb-2">Câmbio em tempo real</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-4">Converta salários e custos com taxas atualizadas por moeda.</p>
                    <span class="text-xs text-slate-400 font-medium">Open Exchange</span>
                </div>

                {{-- Salários --}}
                <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:border-cyan-400 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-cyan-50 rounded-lg flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                        </svg>
                    </div>
                    <h3 class="text-slate-900 font-semibold mb-2">Salários de mercado</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-4">Benchmarks por cargo, stack e país com base em dados reais.</p>
                    <span class="text-xs text-slate-400 font-medium">Stack Overflow Survey</span>
                </div>

                {{-- Insights culturais --}}
                <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:border-cyan-400 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-cyan-50 rounded-lg flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="9"/>
                            <ellipse cx="12" cy="12" rx="4" ry="9"/>
                            <line x1="3" y1="12" x2="21" y2="12"/>
                        </svg>
                    </div>
                    <h3 class="text-slate-900 font-semibold mb-2">Insights culturais</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-4">Comunicação, hierarquia e costumes para evitar mal-entendidos.</p>
                    <span class="text-xs text-slate-400 font-medium">Gemini AI</span>
                </div>

                {{-- PDF --}}
                <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:border-cyan-400 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-cyan-50 rounded-lg flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10 9 9 9 8 9"/>
                        </svg>
                    </div>
                    <h3 class="text-slate-900 font-semibold mb-2">Relatório em PDF</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-4">Exporte tudo em um documento pronto para apresentar ao time.</p>
                    <span class="text-xs text-slate-400 font-medium">DomPDF</span>
                </div>

                {{-- Leis trabalhistas --}}

            </div>
        </div>
    </section>

    {{-- SOBRE / CTA --}}
    <section id="sobre" class="bg-[#080E1A] border-t border-white/10 px-6 sm:px-10 py-24 text-center">
        <div class="max-w-2xl mx-auto">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Pronto para contratar sem fronteiras?</h2>
            <p class="text-white/50 text-base leading-relaxed mb-8">
                Crie sua conta grátis e gere seu primeiro relatório em minutos.
            </p>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="inline-block bg-white text-[#080E1A] font-semibold px-8 py-3 rounded-lg hover:bg-white/90 transition">
                    Criar conta gratuita
                </a>
            @endif
        </div>
    </section>

</body>
</html>
