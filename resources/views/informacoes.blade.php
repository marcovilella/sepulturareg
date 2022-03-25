@extends('layout')
@section('secao')
    <nav class="navbar navbar-expand-lg sticky-top navbar-light col-12 bg-prm">
        <div class="container-fluid">
            <a class="navbar-brand" href="/inicio">
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
                        <a class="text-white nav-link me-5 dropdown-toggle" href="#" name="nome_usuario" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

    {{-- Se o usuário não tem nenhuma informação cadastrada aparece o form para cadastrar informações --}}
    @if (!$informacao)
        <form action="salvar-informacoes" method="post">
            @csrf
            <div class="col-12 mt-2">
                @if (session('success'))
                    <div class="alert alert-success text-center mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="col-xl-5 col-12 mb-5 mx-auto">
                    <h5 class="text-center"><strong>Informações</strong></h5>
                    <div class="row">
                        <div class="mb-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                            <label for="cemiterio">Cemitério</label>

                            <select class="form-select" name="cemiterio" id="cemiterio">
                                <option value="">Selecione</option>
                                <option {{ old('cemiterio') == 'Cemitério São Pedro' ? 'selected' : '' }} value="Cemitério São Pedro">Cemitério São Pedro</option>
                                <option {{ old('cemiterio') == 'Cemitério Nossa Senhora da Glória' ? 'selected' : '' }} value="Cemitério Nossa Senhora da Glória">Cemitério Nossa Senhora da Glória</option>
                                <option {{ old('cemiterio') == 'Cemitério Bom Jesus' ? 'selected' : '' }} value="Cemitério Bom Jesus">Cemitério Bom Jesus</option>
                                <option {{ old('cemiterio') == 'Não Declarado' ? 'selected' : '' }} value="Não Declarado">Não Declarado</option>
                            </select>

                            {{-- <input type="text" class="form-control" value="{{ old('cemiterio') }}" name="cemiterio"
                                id="cemiterio"> --}}
                        </div>
                        <div class="mb-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                            <label for="quadra">Quadra</label>
                            <input type="text" class="form-control" value="{{ old('quadra') }}" name="quadra"
                                id="quadra">
                        </div>
                        <div class="mb-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                            <label for="jazigo">Jazigo</label>
                            <input type="text" class="form-control" value="{{ old('jazigo') }}" name="jazigo"
                                id="jazigo">
                        </div>
                        <div class="mb-3 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="nome_permissionario">Nome do Permissionário *</label>
                            <input type="text" class="form-control  @error('nome_permissionario') is-invalid @enderror"
                                value="{{ old('nome_permissionario') }}" name="nome_permissionario"
                                id="nome_permissionario">
                            @error('nome_permissionario')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12">
                            <label for="permissionario_vivo">O Permissionário é vivo? *</label>
                            <div class="form-check">
                                <input class="form-check-input @error('permissionario_vivo') is-invalid @enderror"
                                    type="radio" name="permissionario_vivo" value="Sim" id="sim_vivo">
                                <label class="form-check-label" for="sim_vivo">
                                    Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input @error('permissionario_vivo') is-invalid @enderror"
                                    type="radio" name="permissionario_vivo" value="Não" id="nao_vivo">
                                <label class="form-check-label" for="nao_vivo">
                                    Não
                                </label>
                            </div>
                            @error('permissionario_vivo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12">
                            <label for="manutencao_permissao_jazigo">Tem Interesse na Manutenção da Permissão do Jazigo?
                                *</label>
                            <div class="form-check">
                                <input class="form-check-input @error('manutencao_permissao_jazigo') is-invalid @enderror"
                                    type="radio" name="manutencao_permissao_jazigo" value="Sim" id="sim_jazigo">
                                <label class="form-check-label" for="sim_jazigo">
                                    Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input @error('manutencao_permissao_jazigo') is-invalid @enderror"
                                    type="radio" name="manutencao_permissao_jazigo" value="Não" id="nao_jazigo">
                                <label class="form-check-label" for="nao_jazigo">
                                    Não
                                </label>
                            </div>
                            @error('manutencao_permissao_jazigo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button class="btn btn-prm">Salvar Informações</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- Se o usuário tiver alguma informação cadastrada aparece o form para edição --}}
    @else
        <div class="col-12 mt-2">
            @if (session('success'))
                <div class="alert alert-success text-center mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-xl-5 col-12 mb-5 mx-auto">
                <h5 class="text-center"><strong>Informações</strong></h5>
                <form action="/editar-informacoes/{{ $informacao->id }}" method="POST">
                    @method("PUT")
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                            <label for="cemiterio">Cemitério</label>
                                <select class="form-select" name="cemiterio" id="cemiterio">
                                    <option value="">Selecione</option>
                                    <option {{ $informacao->cemiterio == 'Cemitério São Pedro' ? 'selected' : '' }} value="Cemitério São Pedro">Cemitério São Pedro</option>
                                    <option {{ $informacao->cemiterio == 'Cemitério Nossa Senhora da Glória' ? 'selected' : '' }} value="Cemitério Nossa Senhora da Glória">Cemitério Nossa Senhora da Glória</option>
                                    <option {{ $informacao->cemiterio == 'Cemitério Bom Jesus' ? 'selected' : '' }} value="Cemitério Bom Jesus">Cemitério Bom Jesus</option>
                                    <option {{ $informacao->cemiterio == 'Não Declarado' ? 'selected' : '' }} value="Não Declarado">Não Declarado</option>
                                </select>
                        </div>
                        <div class="mb-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                            <label for="quadra">Quadra</label>
                            <input type="text" class="form-control" value="{{ $informacao->quadra }}" name="quadra"
                                id="quadra">
                        </div>
                        <div class="mb-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                            <label for="jazigo">Jazigo</label>
                            <input type="text" class="form-control" value="{{ $informacao->jazigo }}" name="jazigo"
                                id="jazigo">
                        </div>
                        <div class="mb-3 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="nome_permissionario">Nome do Permissionário *</label>
                            <input type="text" class="form-control  @error('nome_permissionario') is-invalid @enderror"
                                value="{{ $informacao->nome_permissionario }}" name="nome_permissionario"
                                id="nome_permissionario">
                            @error('nome_permissionario')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12">
                            <label for="permissionario_vivo">O Permissionário é vivo? *</label>
                            <div class="form-check">
                                <input class="form-check-input @error('permissionario_vivo') is-invalid @enderror"
                                    type="radio" name="permissionario_vivo"
                                    {{ $informacao->permissionario_vivo == 'Sim' ? 'checked' : '' }} value="Sim"
                                    id="sim_vivo">
                                <label class="form-check-label" for="sim_vivo">
                                    Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input @error('permissionario_vivo') is-invalid @enderror"
                                    type="radio" name="permissionario_vivo"
                                    {{ $informacao->permissionario_vivo == 'Não' ? 'checked' : '' }} value="Não"
                                    id="nao_vivo">
                                <label class="form-check-label" for="nao_vivo">
                                    Não
                                </label>
                            </div>
                            @error('permissionario_vivo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12">
                            <label for="manutencao_permissao_jazigo">Tem Interesse na Manutenção da Permissão do Jazigo?
                                *</label>
                            <div class="form-check">
                                <input class="form-check-input @error('manutencao_permissao_jazigo') is-invalid @enderror"
                                    type="radio" name="manutencao_permissao_jazigo"
                                    {{ $informacao->manutencao_permissao_jazigo == 'Sim' ? 'checked' : '' }} value="Sim"
                                    id="sim_jazigo">
                                <label class="form-check-label" for="sim_jazigo">
                                    Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input @error('manutencao_permissao_jazigo') is-invalid @enderror"
                                    type="radio" name="manutencao_permissao_jazigo"
                                    {{ $informacao->manutencao_permissao_jazigo == 'Não' ? 'checked' : '' }} value="Não"
                                    id="nao_jazigo">
                                <label class="form-check-label" for="nao_jazigo">
                                    Não
                                </label>
                            </div>
                            @error('manutencao_permissao_jazigo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button class="btn btn-prm">Salvar Informações</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection
