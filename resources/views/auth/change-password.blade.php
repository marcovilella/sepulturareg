<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img class="h-20 fill-current text-gray-500"
                    src="{{ config('app.url', 'http://localhost') }}/assets/imgs/Marca-PMC-cor.png" alt="">
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
            </a>
        </x-slot>
        {{-- <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('mudarSenha') }}">
            @csrf
            <!-- Senha Antiga -->
            <div class="mt-4">
                <x-label for="senhaantiga" :value="__('Senha Atual')" />

                <x-input id="senhaantiga" class="block mt-1 w-full @error('senhaantiga') is-invalid @enderror"
                    type="password" name="senhaantiga" />
                @error('senhaantiga')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Nova Senha * (Mínimo de 8 caracteres)')" />

                <x-input id="password" class="block mt-1 w-full @error('password') is-invalid @enderror" type="password"
                    name="password" autocomplete="new-password" :value="old('password')" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirmar Senha *')" />

                <x-input id="password" class="block mt-1 w-full @error('password') is-invalid @enderror" type="password"
                    name="password_confirmation" autocomplete="current-password" :value="old('password')" />
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-button id="alterar" class="ml-4">
                    {{ __('Alterar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
