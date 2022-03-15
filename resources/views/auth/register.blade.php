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

                <x-label for="name" :value="__('Nome Completo *')" />
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

                <x-label for="Doc_Ident" :value="__('Documento de Identificação *')" />
                <x-input id="Doc_Ident" class="block mt-1 w-full  @error('Doc_Ident') is-invalid @enderror" type="text"
                    name="Doc_Ident" :value="old('Doc_Ident')" />
                @error('Doc_Ident')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- CPF -->
            <div class="mt-4">
                <x-label for="CPF" :value="__('CPF *')" />

                <x-input oninput="mascara(this, 'cpf')" id="CPF"
                    class="block mt-1 w-full  @error('CPF') is-invalid @enderror" type="text" name="CPF" /><span
                    class="text-danger fw-bold" id="resposta"></span>
                @error('CPF')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Telefone Celular -->
            <div class="mt-4">
                <x-label for="celular" :value="__('Tel Celular *')" />

                <x-input oninput="mascara(this, 'celular')" id="celular"
                    class="block mt-1 w-full @error('celular') is-invalid @enderror" type="text" name="celular"
                    :value="old('celular')" />
                @error('celular')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
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
                <x-label for="password" :value="__('Senha * (Mínimo de 8 caracteres)')" />

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

            <!-- Endereço -->
            <div class="mt-4">
                {{-- <label for="endereco" class="block font-medium text-sm text-gray-700">Endereço</label>
                <input type="text"
                    class="rounded-md shadow-sm letra-maiuscula border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                    name="endereco" id="endereco"> --}}

                <x-label for="endereco" :value="__('Avenida / Rua / Outro *')" />

                <x-input id="endereco" class="block mt-1 w-full @error('endereco') is-invalid @enderror" type="text"
                    name="endereco" />
                @error('endereco')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Número -->
            <div class="mt-4">
                <x-label for="numero" :value="__('Número *')" />

                <x-input id="numero" class="block mt-1 w-full @error('numero') is-invalid @enderror" type="number"
                    min="0" name="numero" />
                @error('numero')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
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

                <x-label for="bairro" :value="__('Bairro *')" />
                <x-input id="bairro" class="block mt-1 w-full @error('bairro') is-invalid @enderror" type="text"
                    name="bairro" />
                @error('bairro')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Cidade -->
            <div class="mt-4">
                {{-- <label for="cidade" class="block font-medium text-sm text-gray-700">Cidade</label>
                <input type="text"
                    class="rounded-md shadow-sm letra-maiuscula border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                    name="cidade" id="cidade"> --}}

                <x-label for="cidade" :value="__('Cidade *')" />
                <x-input id="cidade" class="block mt-1 w-full @error('cidade') is-invalid @enderror" type="text"
                    name="cidade" />
                @error('cidade')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Estado -->
            <div class="mt-4">
                <x-label for="estado" :value="__('Estado / UF *')" />

                <select id="estado" onchange="habilitarDesabilitar()"
                    class="block mt-1 w-full form-select rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full @error('estado') is-invalid @enderror"
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
                    <option value="Rio Grande do  Sul">Rio Grande do Sul</option>
                    <option value="Rondônia">Rondônia</option>
                    <option value="Santa Catarina">Santa Catarina</option>
                    <option value="São Paulo">São Paulo</option>
                    <option value="Sergipe">Sergipe</option>
                    <option value="Tocantins">Tocantins</option>
                </select>
                @error('estado')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- CEP -->
            <div class="mt-4">
                <x-label for="cep" :value="__('CEP *')" />

                <x-input oninput="mascara(this, 'cep')" id="cep"
                    class="block mt-1 w-full @error('cep') is-invalid @enderror" type="text" name="cep" />
                @error('cep')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Já possui conta?') }}
                </a> --}}

                <x-button id="registrar" class="ml-4">
                    {{ __('Registrar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


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

    function CPF() {
        "user_strict";

        function r(r) {
            for (var t = null, n = 0; 9 > n; ++n) t += r.toString().charAt(n) * (10 - n);
            var i = t % 11;
            return i = 2 > i ? 0 : 11 - i
        }

        function t(r) {
            for (var t = null, n = 0; 10 > n; ++n) t += r.toString().charAt(n) * (11 - n);
            var i = t % 11;
            return i = 2 > i ? 0 : 11 - i
        }
        var n = "CPF Inválido",
            i = "CPF Válido";
        this.gera = function() {
            for (var n = "", i = 0; 9 > i; ++i) n += Math.floor(9 * Math.random()) + "";
            var o = r(n),
                a = n + "-" + o + t(n + "" + o);
            return a
        }, this.valida = function(o) {
            for (var a = o.replace(/\D/g, ""), u = a.substring(0, 9), f = a.substring(9, 11), v = 0; 10 > v; v++)
                if ("" + u + f == "" + v + v + v + v + v + v + v + v + v + v + v) return n;
            var c = r(u),
                e = t(u + "" + c);
            return f.toString() === c.toString() + e.toString() ? i : n
        }
    }

    var CPF = new CPF();

    $("#CPF").keypress(function() {
        $("#resposta").html(CPF.valida($(this).val()));
        enableDisableButton(resposta);
    });

    $("#CPF").blur(function() {
        $("#resposta").html(CPF.valida($(this).val()));
        enableDisableButton(resposta);
    });

    $("#CPF").keyup(function() {
        $("#resposta").html(CPF.valida($(this).val()));
        enableDisableButton(resposta);
    });


    // document.getElementById("registrar").disabled = true;

    window.onload = initPage();


    function initPage() {
        var resposta = document.getElementById("resposta");

        if (resposta.innerHTML != "CPF Válido") {
            resposta.classList.replace('text-success', 'text-danger');
            document.getElementById("registrar").disabled = true;
        }

        $("#CPF").keypress(function() {
            $("#resposta").html(CPF.valida($(this).val()));
            enableDisableButton(resposta);
        });

        $("#CPF").blur(function() {
            $("#resposta").html(CPF.valida($(this).val()));
            enableDisableButton(resposta);
        });

        $("#CPF").keyup(function() {
            $("#resposta").html(CPF.valida($(this).val()));
            enableDisableButton(resposta);
        });
    }


    // Função para habilitar ou desabilitar botão de registro
    function enableDisableButton(resposta) {

        if (resposta.innerHTML != "CPF Válido") {
            resposta.classList.replace('text-success', 'text-danger');
            document.getElementById("registrar").disabled = true;
        } else {
            resposta.classList.replace('text-danger', 'text-success');
            document.getElementById("registrar").disabled = false;
        }
    }

    let nome = document.getElementById("name");
    let doc_ident = document.getElementById("Doc_Ident");
    let cp = document.getElementById("CPF");
    let celular = document.getElementById("celular");
    let endereco = document.getElementById("endereco");
    let numero = document.getElementById("numero");
    let bairro = document.getElementById("bairro");
    let cidade = document.getElementById("cidade");
    let estado = document.getElementById("estado");
    
    let cep = document.getElementById("cep");


    var i = 0;
    function habilitarDesabilitar() {
        var opcao = estado.options[estado.selectedIndex];
        console.log(opcao.value);
        if (nome.value.length < 6 || doc_ident.value.length < 6 || cp.value.length < 14 || celular.value.length < 15 ||
            endereco.value.length < 4 || cep.value.length < 8 || numero.value.length < 1 || bairro.value.length < 3 ||
            cidade.value.length < 3 || bairro.value.length < 3 || opcao.value == "" || cep.value.length < 9) {
            document.getElementById("registrar").disabled = true;
            console.log(i);
            i++
        } else {
            document.getElementById("registrar").disabled = false;
            enableDisableButton(resposta);
        }
    }
    nome.onblur = function() {
        habilitarDesabilitar();
    }
    doc_ident.onblur = function() {
        habilitarDesabilitar();
    }
    cp.onblur = function() {
        habilitarDesabilitar();
    }
    celular.onblur = function() {
        habilitarDesabilitar();
    }
    endereco.onblur = function() {
        habilitarDesabilitar();
    }
    numero.onblur = function() {
        habilitarDesabilitar();
    }
    bairro.onblur = function() {
        habilitarDesabilitar();
    }
    cidade.onblur = function() {
        habilitarDesabilitar();
    }
    estado.onblur = function() {
        habilitarDesabilitar();
    }
    cep.onblur = function() {
        habilitarDesabilitar();
    }
</script>
