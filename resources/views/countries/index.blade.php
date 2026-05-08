<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="min-h-screen flex flex-col justify-center items-center">
        <h1 class="mb-4 text-3xl font-bold text-heading md:text-4xl lg:text-5xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Lista de paises</h1>
        <form class="flex flex-col" action="{{ route('countries.index') }}" method="GET">
            <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            type="text"
            name="search"
            list="countries"
            placeholder="Buscar país"
        >

            <datalist id="countries">

            @foreach($countries as $country)
                <option value="{{ $country->name }}">
            @endforeach

            </datalist>

            <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded" type="submit">
                Buscar
            </button>
            <div class="mt-6">

                @foreach($countries as $country)

                    <div class="p-2 border-b">
                        {{ $country->flag_emoji }}
                        {{ $country->name }}
                    </div>

                @endforeach

            </div>

    </div>

</body>
</html>
