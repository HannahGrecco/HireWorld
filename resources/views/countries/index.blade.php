<x-countries-layout title="HireWorld — Países">
    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="mb-8">
            <p class="text-cyan-400 text-xs font-semibold tracking-widest uppercase mb-2">Explorar</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-white">Lista de países</h1>
            <p class="text-white/50 text-sm mt-2">Escolha um país para ver feriados, câmbio, salários e cultura local.</p>
        </div>

        {{-- Search --}}
        <form action="{{ route('countries.index') }}" method="GET" class="flex gap-3 mb-8">
            <input
                class="flex-1 bg-white/5 border border-white/10 text-white placeholder-white/30 focus:border-cyan-400 focus:ring-cyan-400 rounded-lg px-4 py-2.5 text-sm outline-none transition"
                type="text"
                name="search"
                list="countries-list"
                placeholder="Buscar país..."
                value="{{ request('search') }}"
            >
            <datalist id="countries-list">
                @foreach($countries as $country)
                    <option value="{{ $country->name }}">
                @endforeach
            </datalist>
            <button class="bg-white text-[#080E1A] font-semibold text-sm px-5 py-2.5 rounded-lg hover:bg-white/90 transition" type="submit">
                Buscar
            </button>
        </form>

        {{-- Country list --}}
        <div class="bg-white/5 border border-white/10 rounded-2xl overflow-hidden">
            @foreach($countries as $country)
                <a href="{{ url('/countries/' . $country->id) }}"
                   class="flex items-center justify-between px-5 py-4 border-b border-white/5 hover:bg-white/5 transition last:border-0">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl leading-none">{{ $country->flag_emoji }}</span>
                        <span class="text-white text-sm font-medium">{{ $country->name }}</span>
                    </div>
                    <span class="text-white/30 text-xs">{{ $country->iso_code }}</span>
                </a>
            @endforeach
        </div>

    </div>
</x-countries-layout>
