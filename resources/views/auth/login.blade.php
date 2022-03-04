<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img class="h-20 fill-current text-gray-500"
                    src="{{ config('app.url', 'http://localhost') }}/assets/imgs/Marca-PMC-cor.png" alt="">
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- CPF -->
            <div class="mt-4">
                <x-label for="CPF" :value="__('CPF')" />

                <x-input oninput="mascara(this, 'cpf')" id="CPF" class="block mt-1 w-full" type="text" name="CPF"
                    :value="old('CPF')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Senha')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            {{-- <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Lembrar conta') }}</span>
                </label>
            </div> --}}

            <div class="flex items-center justify-center mt-4">
                <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4" href="{{ route('register') }}">
                        Registrar
                </a>

                <x-button class="ml-3">
                    {{ __('Entrar') }}
                </x-button>
            </div>

            @if (Route::has('password.request'))
                <div class="col-12 mt-4 text-center">
                    <a class="ml-3 underline text-sm text-center text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('Esqueci minha senha') }}
                    </a>
                </div>
            @endif
        </form>
    </x-auth-card>
</x-guest-layout>

{{-- Função para colocar máscara no input --}}
<script>
    function mascara(i, t) {

        var v = i.value;

        //Isso não permite que sejam inseridos caracteres diferentes de números
        if (isNaN(v[v.length - 1])) {
            i.value = v.substring(0, v.length - 1);
            return;
        }

        if (t == "cpf") {
            i.setAttribute("maxlength", "14");
            if (v.length == 3 || v.length == 7) i.value += ".";
            if (v.length == 11) i.value += "-";
        }
    }
</script>