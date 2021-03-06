@extends('layout')
@section('secao')
    <nav class="navbar navbar-expand-lg sticky-top navbar-light col-12 bg-prm">
        <div class="container-fluid">
            <a class="navbar-brand" href="/dashboard">
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
        <a href="dashboard" class="btn btn-prm mb-1 col-xl-2 col-lg-3 col-md-3 col-sm-3 col-xs-11">Ver Todos</a>
        <a href="completos" class="btn btn-prm mb-1 col-xl-2 col-lg-3 col-md-3 col-sm-3 col-xs-11">Ver Completos</a>
        <a href="incompletos" class="btn btn-prm mb-1 col-xl-2 col-lg-3 col-md-3 col-sm-3 col-xs-11">Ver Incompletos</a>
    </div>
    @if ($usuarios)
        <div class="col-12 text-center mb-2">
            <a class="btn btn-prm mb-1 col-xl-2 col-lg-3 col-md-3 col-sm-3 col-xs-11"
                href="{{ route('export') }}">Exportar dados</a>
        </div>
    @endif
    <div class="col-xl-11 mx-auto">
        @if (!$usuarios)
            @if ($rota == 'completos' || $rota == 'incompletos')
                <h4 class="text-center mt-5">N??o foram encontrados usu??rios {{ $rota }}</h4>
            @else
                <h4 class="text-center mt-5">N??o foram encontrados usu??rios</h4>
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
                                        <strong>Nome usu??rio</strong>: {{ $usuario->name }}
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
                                    <p class="text-center p-2 bg-light">Informa????es pessoais</p>
                                    <ul>
                                        <li>
                                            <strong>Nome</strong>: {{ $usuario->name }}
                                        </li>
                                        <li>
                                            <strong>Email</strong>:
                                            @if ($usuario->email)
                                                {{ $usuario->email }}
                                            @else
                                                N??o cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Documento de Identifica????o</strong>:
                                            @if ($usuario->Doc_Ident)
                                                {{ $usuario->Doc_Ident }}
                                            @else
                                                N??o cadastrado
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
                                                N??o cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Fixo</strong>:
                                            @if ($usuario->fixo)
                                                {{ $usuario->fixo }}
                                            @else
                                                N??o cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Whatsapp / Telegram</strong>:
                                            @if ($usuario->whats_tele)
                                                {{ $usuario->whats_tele }}
                                            @else
                                                N??o cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Endere??o</strong>:
                                            @if ($usuario->endereco)
                                                {{ $usuario->endereco }}
                                            @else
                                                N??o cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>N??mero</strong>:
                                            @if ($usuario->numero)
                                                {{ $usuario->numero }}
                                            @else
                                                N??o cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Complemento</strong>:
                                            @if ($usuario->complemento)
                                                {{ $usuario->complemento }}
                                            @else
                                                N??o cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Bairro</strong>:
                                            @if ($usuario->bairro)
                                                {{ $usuario->bairro }}
                                            @else
                                                N??o cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Cidade</strong>:
                                            @if ($usuario->cidade)
                                                {{ $usuario->cidade }}
                                            @else
                                                N??o cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>Estado</strong>:
                                            @if ($usuario->estado)
                                                {{ $usuario->estado }}
                                            @else
                                                N??o cadastrado
                                            @endif
                                        </li>
                                        <li>
                                            <strong>CEP</strong>:
                                            @if ($usuario->cep)
                                                {{ $usuario->cep }}
                                            @else
                                                N??o cadastrado
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xs-6 col-lg-6 col-sm-12 col-xs-12">
                                    <p class="text-center p-2 bg-light">Documentos</p>
                                    @if ($usuario->informacoes)
                                        <ul>
                                            <li>
                                                <strong>Cemit??rio</strong>:
                                                @if ($usuario->informacoes->cemiterio)
                                                    {{ $usuario->informacoes->cemiterio }}
                                                @else
                                                    N??o informado
                                                @endif

                                            </li>
                                            <li>
                                                <strong>Quadra</strong>:
                                                @if ($usuario->informacoes->quadra)
                                                    {{ $usuario->informacoes->quadra }}
                                                @else
                                                    N??o informada
                                                @endif
                                            </li>
                                            <li>
                                                <strong>Jazigo</strong>:
                                                @if ($usuario->informacoes->jazigo)
                                                    {{ $usuario->informacoes->jazigo }}
                                                @else
                                                    N??o informado
                                                @endif
                                            </li>
                                            <li>
                                                <strong>Nome do Permission??rio</strong>:
                                                @if ($usuario->informacoes->nome_permissionario)
                                                    {{ $usuario->informacoes->nome_permissionario }}
                                                @else
                                                    N??o informado
                                                @endif
                                            </li>
                                            <li>
                                                <strong>O Permission??rio ?? Vivo?</strong>:
                                                @if ($usuario->informacoes->permissionario_vivo)
                                                    {{ $usuario->informacoes->permissionario_vivo }}
                                                @else
                                                    N??o informado
                                                @endif
                                            </li>
                                            <li>
                                                <strong>Tem interesse na Manuten????o da Permiss??o do Jazigo?</strong>:
                                                @if ($usuario->informacoes->manutencao_permissao_jazigo)
                                                    {{ $usuario->informacoes->manutencao_permissao_jazigo }}
                                                @else
                                                    <ul>
                                                        <li>
                                                            N??o informado
                                                        </li>
                                                    </ul>
                                                @endif
                                            </li>
                                        </ul>
                                    @else
                                        <ul>
                                            <li>
                                                <strong>Cemit??rio</strong>: N??o informado
                                            </li>
                                            <li>
                                                <strong>Quadra</strong>: N??o informada
                                            </li>
                                            <li>
                                                <strong>Jazigo</strong>: N??o informado
                                            </li>
                                            <li>
                                                <strong>Nome do Permission??rio</strong>: N??o informado
                                            </li>
                                            <li>
                                                <strong>O Permission??rio ?? Vivo?</strong>: N??o informado
                                            </li>
                                            <li>
                                                <strong>Tem interesse na Manuten????o da Permiss??o do Jazigo?</strong>: N??o
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
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    Nenhum usu??rio
            @endforelse
        @endif
    </div>
    </div>
@endsection
