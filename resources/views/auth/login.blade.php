<x-guest-layout>
    <h1 class="text-2xl font-bold text-white mb-1">Entrar</h1>
    <p class="text-white/40 text-sm mb-8">Bem-vindo de volta ao HireWorld</p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-white/20 bg-white/5 text-cyan-400 focus:ring-cyan-400" name="remember">
                <span class="text-sm text-white/50">{{ __('Lembrar de mim') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="text-sm text-white/40 hover:text-white transition" href="{{ route('password.request') }}">
                    {{ __('Esqueceu sua senha?') }}
                </a>
            @endif

            <x-primary-button>
                {{ __('Entrar') }}
            </x-primary-button>
        </div>

        <p class="text-center text-sm text-white/40 mt-6">
            Não tem conta?
            <a href="{{ route('register') }}" class="text-white hover:text-cyan-400 transition">Cadastre-se</a>
        </p>
    </form>
</x-guest-layout>
