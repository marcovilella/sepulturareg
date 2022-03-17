{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Você está logado!
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('layout')
@section('secao')
    <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-prm">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{ config('app.url', 'http://localhost') }}/assets/imgs/Marca-PMC-cor.png"
                    style="height: 40px; width: 90px; overflow-wrap: break-word;"
                    class="bg-light d-inline-block h-10 img-fluid align-center" class="img-thumbnail" alt="...">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="text-white nav-link me-5 dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a href="{{ route('alterar-senha') }}" class="dropdown-item">Alterar Senha</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <a class="dropdown-item" :href="route('logout')"
                                        onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                        this.closest('form').submit();">
                                        {{ __('Sair') }}
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="col-12 text-center mb-2 mt-4">
        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif
        <a href="dashboard" class="btn btn-prm mb-1">Ver Todos</a>
        <a href="completos" class="btn btn-prm mb-1">Ver Completos</a>
        <a href="incompletos" class="btn btn-prm mb-1">Ver Incompletos</a>
    </div>
    <div class="col-xl-11 mx-auto">
        @if (!$usuarios)
            @if ($rota == 'completos' || $rota == 'incompletos')
                <h4 class="text-center mt-5">Não foram encontrados usuários {{ $rota }}</h4>
            @else
                <h4 class="text-center mt-5">Não foram encontrados usuários</h4>
            @endif
        @else
            @forelse ($usuarios as $usuario)
                <div class="accordion" id="accordionUsuario">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $usuario->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $usuario->id }}" aria-expanded="false"
                                aria-controls="collapse{{ $usuario->id }}">
                                <div class="row col-12">
                                    <div class="col-xl-4 col-sm-12 mb-1">
                                        <strong>Nome usuário</strong>: {{ $usuario->name }}
                                    </div>
                                    <div class="col-xl-4 col-sm-6 col-xs-6 mb-1">
                                        <strong>CPF</strong>: {{ $usuario->CPF }}
                                    </div>
                                    <div class="col-xl-4 col-sm-6 col-xs-6">
                                        @if ($usuario->informacoes)
                                            @if ($usuario->documentos->count() < 7 || !$usuario->informacoes->nome_permissionario || !$usuario->informacoes->permissionario_vivo || !$usuario->informacoes->manutencao_permissao_jazigo)
                                                <strong>Status</strong>: Incompleto
                                            @else
                                                <strong>Status</strong>: Completo
                                            @endif
                                        @else
                                            <strong>Status</strong>: Incompleto
                                        @endif


                                    </div>
                                </div>

                            </button>
                        </h2>
                        <div id="collapse{{ $usuario->id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $usuario->id }}"
                            data-bs-parent="#accordionUsuario{{ $usuario->id }}">
                            <div class="accordion-body row">
                                <div class="col-xs-6 col-lg-6 col-sm-12 col-xs-12 text-justify">
                                    <p class="text-center p-2 bg-light">Informações pessoais</p>
                                    <ul>
                                        <li>
                                            <strong>Nome</strong>: {{ $usuario->name }}
                                        </li>
                                        <li>
                                            <strong>Email</strong>:
                                            @if ($usuario->email)
                                                {{ $usuario->email }}
                                            @else
                                                Não cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Documento de Identificação</strong>:
                                            @if ($usuario->Doc_Ident)
                                                {{ $usuario->Doc_Ident }}
                                            @else
                                                Não cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>CPF</strong>: {{ $usuario->CPF }}
                                        </li>
                                        <li>
                                            <strong>Celular</strong>:
                                            @if ($usuario->celular)
                                                {{ $usuario->celular }}
                                            @else
                                                Não cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Fixo</strong>:
                                            @if ($usuario->fixo)
                                                {{ $usuario->fixo }}
                                            @else
                                                Não cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Whatsapp / Telegram</strong>:
                                            @if ($usuario->whats_tele)
                                                {{ $usuario->whats_tele }}
                                            @else
                                                Não cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Endereço</strong>:
                                            @if ($usuario->endereco)
                                                {{ $usuario->endereco }}
                                            @else
                                                Não cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Número</strong>:
                                            @if ($usuario->numero)
                                                {{ $usuario->numero }}
                                            @else
                                                Não cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Complemento</strong>:
                                            @if ($usuario->complemento)
                                                {{ $usuario->complemento }}
                                            @else
                                                Não cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Bairro</strong>:
                                            @if ($usuario->bairro)
                                                {{ $usuario->bairro }}
                                            @else
                                                Não cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Cidade</strong>:
                                            @if ($usuario->cidade)
                                                {{ $usuario->cidade }}
                                            @else
                                                Não cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Estado</strong>:
                                            @if ($usuario->estado)
                                                {{ $usuario->estado }}
                                            @else
                                                Não cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>CEP</strong>:
                                            @if ($usuario->cep)
                                                {{ $usuario->cep }}
                                            @else
                                                Não cadastrado
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                                {{-- @if ($usuario->documentos->count() > 0) --}}
                                <div class="col-xs-6 col-lg-6 col-sm-12 col-xs-12">
                                    <p class="text-center p-2 bg-light">Documentos</p>
                                    @if ($usuario->informacoes)
                                        <ul>
                                            <li>
                                                <strong>Cemitério</strong>:
                                                @if ($usuario->informacoes->cemiterio)
                                                    {{ $usuario->informacoes->cemiterio }}
                                                @else
                                                    Não informado
                                                @endif

                                            </li>
                                            <li>
                                                <strong>Quadra</strong>:
                                                @if ($usuario->informacoes->quadra)
                                                    {{ $usuario->informacoes->quadra }}
                                                @else
                                                    Não informada
                                                @endif
                                            </li>
                                            <li>
                                                <strong>Jazigo</strong>:
                                                @if ($usuario->informacoes->jazigo)
                                                    {{ $usuario->informacoes->jazigo }}
                                                @else
                                                    Não informado
                                                @endif
                                            </li>
                                            <li>
                                                <strong>Nome do Permissionário</strong>:
                                                @if ($usuario->informacoes->nome_permissionario)
                                                    {{ $usuario->informacoes->nome_permissionario }}
                                                @else
                                                    Não informado
                                                @endif
                                            </li>
                                            <li>
                                                <strong>O Permissionário é Vivo?</strong>:
                                                @if ($usuario->informacoes->permissionario_vivo)
                                                    {{ $usuario->informacoes->permissionario_vivo }}
                                                @else
                                                    Não informado
                                                @endif
                                            </li>
                                            <li>
                                                <strong>Tem interesse na Manutenção da Permissão do Jazigo?</strong>:
                                                @if ($usuario->informacoes->manutencao_permissao_jazigo)
                                                    {{ $usuario->informacoes->manutencao_permissao_jazigo }}
                                                @else
                                                    <ul>
                                                        <li>
                                                            Não informado
                                                        </li>
                                                    </ul>
                                                @endif
                                            </li>
                                        </ul>
                                    @else
                                        <ul>
                                            <li>
                                                <strong>Cemitério</strong>: Não informado
                                            </li>
                                            <li>
                                                <strong>Quadra</strong>: Não informada
                                            </li>
                                            <li>
                                                <strong>Jazigo</strong>: Não informado
                                            </li>
                                            <li>
                                                <strong>Nome do Permissionário</strong>: Não informado
                                            </li>
                                            <li>
                                                <strong>O Permissionário é Vivo?</strong>: Não informado
                                            </li>
                                            <li>
                                                <strong>Tem interesse na Manutenção da Permissão do Jazigo?</strong>: Não
                                                informado
                                            </li>
                                        </ul>
                                    @endif
                                    <div class="text-center">
                                        @foreach ($usuario->documentos->sortBy('tipo_doc') as $documento)
                                            <button class="btn btn-prm btn-dashboard mb-1" data-bs-toggle="modal"
                                                data-bs-target="#documento{{ $documento->id }}_Modal">Ver
                                                {{ $documento->nome }}</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="documento{{ $documento->id }}_Modal"
                                                tabindex="-1" aria-labelledby="FrenteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="termosUsoLabel">
                                                                {{ $documento->nome }}</h5>
                                                            <button type="button" class="btn-close mr-auto"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body mx-auto">
                                                            <img src="{{ config('app.url', 'http://localhost') }}/{{ $documento->imagem }}"
                                                                class="img-fluid mx-auto" alt="...">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Fechar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            {{-- @if ($documento->tipo_doc == 1)
                                                <a data-bs-toggle="modal" data-bs-target="#Doc_Ident_Frente_Modal">Documento de
                                                    Identificação Frente</a>
                                                <!-- Modal Identidade Frente -->
                                                <div class="modal fade" id="Doc_Ident_Frente_Modal" tabindex="-1"
                                                    aria-labelledby="FrenteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="termosUsoLabel">
                                                                    {{ $documento->nome }}</h5>
                                                                <button type="button" class="btn-close mr-auto"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body mx-auto">
                                                                <img src="{{ config('app.url', 'http://localhost') }}/{{ $documento->imagem }}"
                                                                    class="img-fluid mx-auto" alt="...">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Fechar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                            @endif
                                            @if ($documento->tipo_doc == 2)
                                                <a data-bs-toggle="modal" data-bs-target="#Doc_Ident_Verso_Modal">Documento de
                                                    Identificação Verso</a>
                                                <!-- Modal Identidade Verso -->
                                                <div class="modal fade" id="Doc_Ident_Verso_Modal" tabindex="-1"
                                                    aria-labelledby="VersoModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="termosUsoLabel">
                                                                    {{ $documento->nome }}</h5>
                                                                <button type="button" class="btn-close mr-auto"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body mx-auto">
                                                                <img src="{{ config('app.url', 'http://localhost') }}/{{ $documento->imagem }}"
                                                                    class="img-fluid mx-auto" alt="...">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Fechar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                            @endif
                                            @if ($documento->tipo_doc == 3)
                                                <a data-bs-toggle="modal" data-bs-target="#CPF_Modal">CPF</a>
                                                <!-- Modal CPF -->
                                                <div class="modal fade" id="CPF_Modal" tabindex="-1"
                                                    aria-labelledby="VersoModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="termosUsoLabel">
                                                                    {{ $documento->nome }}</h5>
                                                                <button type="button" class="btn-close mr-auto"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body mx-auto">
                                                                <img src="{{ config('app.url', 'http://localhost') }}/{{ $documento->imagem }}"
                                                                    class="img-fluid mx-auto" alt="...">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Fechar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                            @endif
                                            @if ($documento->tipo_doc == 4)
                                                <a data-bs-toggle="modal" data-bs-target="#Comprovante_Endereco_Modal">Comprovante
                                                    de Endereço</a>
                                                <!-- Modal Comprovante de Endereço -->
                                                <div class="modal fade" id="Comprovante_Endereco_Modal" tabindex="-1"
                                                    aria-labelledby="VersoModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="termosUsoLabel">
                                                                    {{ $documento->nome }}</h5>
                                                                <button type="button" class="btn-close mr-auto"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body mx-auto">
                                                                <img src="{{ config('app.url', 'http://localhost') }}/{{ $documento->imagem }}"
                                                                    class="img-fluid mx-auto" alt="...">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Fechar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                            @endif
                                            @if ($documento->tipo_doc == 5)
                                                <a data-bs-toggle="modal"
                                                    data-bs-target="#Comprovante_Titularidade_Jazigo_Modal">Comprovante de
                                                    Titularidade de Jazigo</a>
                                                <!-- Modal Comprovante de Titularidade de Jazigo -->
                                                <div class="modal fade" id="Comprovante_Titularidade_Jazigo_Modal" tabindex="-1"
                                                    aria-labelledby="VersoModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="termosUsoLabel">
                                                                    {{ $documento->nome }}</h5>
                                                                <button type="button" class="btn-close mr-auto"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body mx-auto">
                                                                <img src="{{ config('app.url', 'http://localhost') }}/{{ $documento->imagem }}"
                                                                    class="img-fluid mx-auto" alt="...">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Fechar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                            @endif
                                            @if ($documento->tipo_doc == 6)
                                                <a data-bs-toggle="modal" data-bs-target="#Certidao_Obito_Modal">Certidão de
                                                    Óbito</a>
                                                <!-- Modal Certidão de Óbito -->
                                                <div class="modal fade" id="Certidao_Obito_Modal" tabindex="-1"
                                                    aria-labelledby="VersoModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="termosUsoLabel">
                                                                    {{ $documento->nome }}</h5>
                                                                <button type="button" class="btn-close mr-auto"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body mx-auto">
                                                                <img src="{{ config('app.url', 'http://localhost') }}/{{ $documento->imagem }}"
                                                                    class="img-fluid mx-auto" alt="...">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Fechar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                            @endif
                                            @if ($documento->tipo_doc == 7)
                                                <a data-bs-toggle="modal"
                                                    data-bs-target="#Inventario_Formal_Partilha_Modal">Inventário ou Formal de
                                                    Partilha</a>
                                                <!-- Modal Inventário ou Formal de Partilha -->
                                                <div class="modal fade" id="Inventario_Formal_Partilha_Modal" tabindex="-1"
                                                    aria-labelledby="VersoModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="termosUsoLabel">
                                                                    {{ $documento->nome }}</h5>
                                                                <button type="button" class="btn-close mr-auto"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body mx-auto">
                                                                <img src="{{ config('app.url', 'http://localhost') }}/{{ $documento->imagem }}"
                                                                    class="img-fluid mx-auto" alt="...">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Fechar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                            @endif --}}
                                        @endforeach
                                    </div>
                                </div>
                                {{-- @endif --}}

                            </div>
                        </div>
                    </div>
                @empty
                    Nenhum usuário
            @endforelse
        @endif
    </div>
    </div>
@endsection
