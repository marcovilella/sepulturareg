@extends('layout')
@section('secao')
    <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-prm">
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

    <div class="col-12 mt-2">
        @if (session('success'))
        <div class="alert alert-success text-center mb-4">
            {{ session('success') }}
        </div>
    @endif
        <div class="col-xl-5 p-1 mx-auto">
            <div class="mt-5 text-center">
                <h5>Adicionar ou Remover Documentos</h5>
                @if ($documentos < 7)
                    <a href="/documentos" class="text-danger fw-bold">Você possui documentos pendentes favor adicionar</a>
                    <br>
                @endif
                <a href="/documentos" class="btn btn-prm">Documentos</a>

                <h5 class="mt-4">Adicionar ou Editar Informações de Cemitério / Jazigo</h5>
                @if ($informacoes < 1)
                <a href="/informacoes" class="text-danger fw-bold">Você ainda não adicionou informações</a>
                <br>
                @endif
                <a href="/informacoes" class="btn btn-prm">Informacoes</a>
            </div>
        </div>
    @endsection
