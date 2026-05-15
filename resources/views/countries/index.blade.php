<x-countries-layout title="HireWorld">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-semibold text-slate-900 md:text-4xl">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-500 from-sky-400">Lista de paises</span>
                </h1>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-white/95 border border-white/60 text-slate-700 hover:text-slate-900 px-4 py-2 rounded-full text-sm shadow">
                    Sair
                </button>
            </form>
        </div>

        <div class="bg-white/95 rounded-2xl shadow-xl border border-white/60 p-6">

            <p class="text-sm text-slate-600 mt-1 mb-4">Escolha o pais para ver mais sobre.</p>
            <form class="flex flex-col" action="{{ route('countries.index') }}" method="GET">
                <input
                    class="appearance-none block w-full bg-white text-slate-700 border border-slate-200 rounded-lg py-3 px-4 mb-3 leading-tight focus:outline-none focus:ring-2 focus:ring-slate-200"
                    type="text"
                    name="search"
                    list="countries"
                    placeholder="Buscar pais"
                >

                <datalist id="countries">
                    @foreach($countries as $country)
                        <option value="{{ $country->name }}">
                    @endforeach
                </datalist>

                <button class="bg-slate-900 hover:bg-slate-800 text-white font-medium py-2 px-4 rounded-lg" type="submit">
                    Buscar
                </button>
            </form>

            <div class="mt-6 divide-y divide-slate-100">
                @foreach($countries as $country)
                    <a class="block p-3 hover:bg-slate-50 rounded-lg" href="{{ url('/countries/'.$country->id) }}">
                        <span class="me-2">{{ $country->flag_emoji }}</span>
                        <span class="text-slate-800">{{ $country->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-countries-layout>
