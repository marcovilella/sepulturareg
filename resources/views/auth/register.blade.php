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
                {{-- <label for="name" class="block font-medium text-sm text-gray-700">Nome Completo</label>
                <input type="text"
                    class="rounded-md shadow-sm letra-maiuscula border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full @error('name') is-invalid @enderror"
                    name="name" id="name"> --}}

                <x-label for="name" :value="__('Nome Completo')" />
                <x-input id="name" class="block mt-1 w-full @error('name') is-invalid @enderror" type="text" name="name"
                        :value="old('name')" autofocus />
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <!-- Documento Identificação -->
            <div class="mt-4">
                {{-- <label for="Doc_Ident" class="block font-medium text-sm text-gray-700">Documento de Identificação</label>
                <input type="text"
                    class="rounded-md shadow-sm letra-maiuscula border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full @error('Doc_Ident') is-invalid @enderror"
                    name="Doc_Ident" id="Doc_Ident"> --}}

                <x-label for="Doc_Ident" :value="__('Documento de Identificação')" />
                    <x-input id="Doc_Ident" class="block mt-1 w-full  @error('Doc_Ident') is-invalid @enderror" type="text"
                        name="Doc_Ident" :value="old('Doc_Ident')" />
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
                {{-- <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                <input type="email"
                    class="rounded-md shadow-sm letra-minuscula border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full @error('email') is-invalid @enderror"
                    name="email" id="email"> --}}

                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full @error('email') is-invalid @enderror" type="email"
                    name="email" :value="old('email')" />

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
                {{-- <label for="endereco" class="block font-medium text-sm text-gray-700">Endereço</label>
                <input type="text"
                    class="rounded-md shadow-sm letra-maiuscula border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                    name="endereco" id="endereco"> --}}

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
                {{-- <label for="complemento" class="block font-medium text-sm text-gray-700">Complemento</label>
                <input type="text"
                    class="rounded-md shadow-sm letra-maiuscula border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                    name="complemento" id="complemento"> --}}

                <x-label for="complemento" :value="__('Complemento')" />
                <x-input id="complemento" class="block mt-1 w-full" type="text" name="complemento" />
            </div>

            <!-- Bairro -->
            <div class="mt-4">
                {{-- <label for="bairro" class="block font-medium text-sm text-gray-700">Bairro</label>
                <input type="text"
                    class="rounded-md shadow-sm letra-maiuscula border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                    name="bairro" id="bairro"> --}}

                <x-label for="bairro" :value="__('Bairro')" />
                <x-input id="bairro" class="block mt-1 w-full" type="text" name="bairro" />
            </div>

            <!-- Cidade -->
            <div class="mt-4">
                {{-- <label for="cidade" class="block font-medium text-sm text-gray-700">Cidade</label>
                <input type="text"
                    class="rounded-md shadow-sm letra-maiuscula border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                    name="cidade" id="cidade"> --}}

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
                    <option value="Acre">Acre</option>
                    <option value="Alagoas">Alagoas</option>
                    <option value="Amapá">Amapá</option>
                    <option value="Amazonas">Amazonas</option>
                    <option value="Bahia">Bahia</option>
                    <option value="Ceara">Ceara</option>
                    <option value="Distrito Federal">Distrito Federal</option>
                    <option value="Epiríto Santo">Epiríto Santo</option>
                    <option value="Goiás">Goiás</option>
                    <option value="Maranhão">Maranhão</option>
                    <option value="Mato Grosso">Mato Grosso</option>
                    <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                    <option value="Minas Gerais">Minas Gerais</option>
                    <option value="Pará">Pará</option>
                    <option value="Paraíba">Paraíba</option>
                    <option value="Paraná">Paraná</option>
                    <option value="Pernambuco">Pernambuco</option>
                    <option value="Piauí">Piauí</option>
                    <option value="Rio de Janeiro">Rio de Janeiro</option>
                    <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                    <option value="Rio Grande do  Sul">Rio Grande do  Sul</option>
                    <option value="Rondônia">Rondônia</option>
                    <option value="Santa Catarina">Santa Catarina</option>
                    <option value="São Paulo">São Paulo</option>
                    <option value="Sergipe">Sergipe</option>
                    <option value="Tocantins">Tocantins</option>
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
