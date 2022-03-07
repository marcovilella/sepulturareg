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

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block font-medium text-sm text-gray-700">Nome Completo</label>

                <input type="text"
                    class="rounded-md shadow-sm letra-maiuscula border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full @error('name') is-invalid @enderror"
                    name="name" id="name">

                {{-- <x-label for="name" :value="__('Nome Completo')" /> --}}
                {{-- <x-input id="name" class="block mt-1 w-full @error('name') is-invalid @enderror" type="text" name="name"
                        :value="old('name')" autofocus /> --}}
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <!-- Documento Identificação -->
            <div class="mt-4">
                <label for="Doc_Ident" class="block font-medium text-sm text-gray-700">Documento de Identificação</label>
                <input type="text"
                    class="rounded-md shadow-sm letra-maiuscula border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full @error('Doc_Ident') is-invalid @enderror"
                    name="Doc_Ident" id="Doc_Ident">

                {{-- <x-label for="Doc_Ident" :value="__('Documento de Identificação')" />
                    <x-input id="Doc_Ident" class="block mt-1 w-full  @error('Doc_Ident') is-invalid @enderror" type="text"
                        name="Doc_Ident" :value="old('Doc_Ident')" /> --}}
                @error('Doc_Ident')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- CPF -->
            <div class="mt-4">
                <x-label for="CPF" :value="__('CPF')" />

                <x-input oninput="mascara(this, 'cpf')" id="CPF"
                    class="block mt-1 w-full  @error('CPF') is-invalid @enderror" type="text" name="CPF"
                    :value="old('CPF')" />
                @error('CPF')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Telefone Celular -->
            <div class="mt-4">
                <x-label for="celular" :value="__('Tel Celular')" />

                <x-input oninput="mascara(this, 'celular')" id="celular" class="block mt-1 w-full" type="text"
                    name="celular" :value="old('celular')" />
            </div>

            <!-- Whatsapp / Telegram -->
            <div class="mt-4">
                <x-label for="whats_tele" :value="__('Whatsapp / Telegram (Opcional)')" />

                <x-input oninput="mascara(this, 'celular')" id="whats_tele" class="block mt-1 w-full" type="text"
                    name="whats_tele" :value="old('whats_tele')" />
            </div>

            <!-- Telefone Fixo -->
            <div class="mt-4">
                <x-label for="fixo" :value="__('Tel Fixo (Opcional)')" />

                <x-input id="fixo" oninput="mascara(this, 'telefone')" class="block mt-1 w-full" type="text" name="fixo"
                    :value="old('fixo')" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <label for="email">Email</label>
                <input type="email" class="rounded-md shadow-sm letra-maiuscula border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full @error('email') is-invalid @enderror" name="email" id="email">

                {{-- <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full @error('email') is-invalid @enderror" type="email"
                    name="email" :value="old('email')" /> --}}

                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Senha (Mínimo de 8 caracteres)')" />

                <x-input id="password" class="block mt-1 w-full @error('password') is-invalid @enderror" type="password"
                    name="password" autocomplete="new-password" :value="old('password')" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirmar Senha')" />

                <x-input id="password" class="block mt-1 w-full @error('password') is-invalid @enderror" type="password"
                    name="password_confirmation" autocomplete="current-password" :value="old('password')" />
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Endereço -->
            <div class="mt-4">
                <x-label for="endereco" :value="__('Avenida / Rua / Outro')" />

                <x-input id="endereco" class="block mt-1 w-full" type="text" name="endereco" />
            </div>

            <!-- Número -->
            <div class="mt-4">
                <x-label for="numero" :value="__('Número')" />

                <x-input id="numero" class="block mt-1 w-full" type="number" min="0" name="numero" />
            </div>

            <!-- Complemento -->
            <div class="mt-4">
                <x-label for="complemento" :value="__('Complemento')" />

                <x-input id="complemento" class="block mt-1 w-full" type="text" name="complemento" />
            </div>

            <!-- Bairro -->
            <div class="mt-4">
                <x-label for="bairro" :value="__('Bairro')" />

                <x-input id="bairro" class="block mt-1 w-full" type="text" name="bairro" />
            </div>

            <!-- Cidade -->
            <div class="mt-4">
                <x-label for="cidade" :value="__('Cidade')" />

                <x-input id="cidade" class="block mt-1 w-full" type="text" name="cidade" />
            </div>

            <!-- Estado -->
            <div class="mt-4">
                <x-label for="estado" :value="__('Estado / UF')" />

                <select id="estado"
                    class="block mt-1 w-full form-select rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                    type="text" name="estado">
                    <option value="" selected>Selecione</option>
                    <option value="ACRE">ACRE</option>
                    <option value="ALAGOAS">ALAGOAS</option>
                    <option value="AMAPÁ">AMAPÁ</option>
                    <option value="AMAZONAS">AMAZONAS</option>
                    <option value="BAHIA">BAHIA</option>
                    <option value="CEARA">CEARA</option>
                    <option value="DISTRITO FEDERAL">DISTRITO FEDERAL</option>
                    <option value="ESPIRÍTO SANTO">ESPIRÍTO SANTO</option>
                    <option value="GOIÁS">GOIÁS</option>
                    <option value="MARANHÃO">MARANHÃO</option>
                    <option value="MATO GROSSO">MATO GROSSO</option>
                    <option value="MATO GROSSO DO SUL">MATO GROSSO DO SUL</option>
                    <option value="MINAS GERAIS">MINAS GERAIS</option>
                    <option value="PARÁ">PARÁ</option>
                    <option value="PARAÍBA">PARAÍBA</option>
                    <option value="PARANÁ">PARANÁ</option>
                    <option value="PERNAMBUCO">PERNAMBUCO</option>
                    <option value="PIAUÍ">PIAUÍ</option>
                    <option value="RIO DE JANEIRO">RIO DE JANEIRO</option>
                    <option value="RIO GRANDE DO NORTE">RIO GRANDE DO NORTE</option>
                    <option value="RIO GRANDE DO SUL">RIO GRANDE DO SUL</option>
                    <option value="RONDÔNIA">RONDÔNIA</option>
                    <option value="SANTA CATARINA">SANTA CATARINA</option>
                    <option value="SÃO PAULO">SÃO PAULO</option>
                    <option value="SERGIPE">SERGIPE</option>
                    <option value="TOCANTINS">TOCANTINS</option>
                </select>
            </div>

            <!-- CEP -->
            <div class="mt-4">
                <x-label for="cep" :value="__('CEP')" />

                <x-input oninput="mascara(this, 'cep')" id="cep" class="block mt-1 w-full" type="text" name="cep" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Já possui conta?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Registrar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

{{-- Função para colocar máscara no input --}}
<script>
    function mascara(i, t) {

        var v = i.value;

        // Isso não permite que sejam inseridos caracteres diferentes de números
        if (isNaN(v[v.length - 1])) {
            i.value = v.substring(0, v.length - 1);
            return;
        }

        // Máscara para o cpf
        if (t == "cpf") {
            i.setAttribute("maxlength", "14");
            if (v.length == 3 || v.length == 7) i.value += ".";
            if (v.length == 11) i.value += "-";
        }

        // Máscara para o celular
        if (t == "celular") {
            i.setAttribute("maxlength", "15");
            if (v.length == 1) i.value = "(" + i.value;
            if (v.length == 3) i.value += ") ";
            if (v.length == 10) i.value += "-";
        }

        // Máscara para o telefone
        if (t == "telefone") {
            i.setAttribute("maxlength", "14");
            if (v.length == 1) i.value = "(" + i.value;
            if (v.length == 3) i.value += ") ";
            if (v.length == 9) i.value += "-";
        }

        // Máscara para o CEP
        if (t == "cep") {
            i.setAttribute("maxlength", "9");
            if (v.length == 5) i.value += "-";
        }

    }
</script>
