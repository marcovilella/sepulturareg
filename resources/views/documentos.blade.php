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

    <div class="col-12 mt-2">
        <h5 class="text-center"><strong>Documentos</strong></h5>

        @if (session('success'))
        <div class="alert alert-success text-center mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger text-center mb-4">
            {{ session('error') }}
        </div>
    @endif
    </div>

    {{-- Form para adicionar os documentos --}}
    <form action="/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-12 mt-2">
            <div class="col-xl-5 mx-auto">
                @if (!$Doc_Ident_Frente)
                    <div class="mb-3">
                        <label for="Doc_Ident_Frente" class="form-label">Documento de Identifica????o Frente <a
                                class="text-danger"><b>Pendente</b></a></label>
                        <input class="form-control" type="file" name="Doc_Ident_Frente" id="Doc_Ident_Frente">
                    </div>
                @endif
                @if (!$Doc_Ident_Verso)
                    <div class="mb-3">
                        <label for="Doc_Ident_Verso" class="form-label">Documento de Identifica????o Verso <a
                                class="text-danger"><b>Pendente</b></a></label>
                        <input class="form-control" type="file" name="Doc_Ident_Verso" id="Doc_Ident_Verso">
                    </div>
                @endif
                {{-- </div> --}}
                @if (!$cpf)
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF <a class="text-danger"><b>Pendente</b></a></label>
                        <input class="form-control" type="file" name="cpf" id="cpf">
                    </div>
                @endif
                @if (!$comprovante_endereco)
                    <div class="mb-3">
                        <label for="comprovante_endereco" class="form-label">Comprovante de Endere??o <a
                                class="text-danger"><b>Pendente</b></a></label>
                        <input class="form-control" type="file" name="comprovante_endereco" id="comprovante_endereco">
                    </div>
                @endif
                @if (!$comprovante_titularidade_jazigo)
                    <div class="mb-3">
                        <label for="comprovante_titularidade_jazigo" class="form-label">Comprovante de Titularidade de
                            Jazigo <a class="text-danger"><b>Pendente</b></a></label>
                        <input class="form-control" type="file" name="comprovante_titularidade_jazigo"
                            id="comprovante_titularidade_jazigo">
                    </div>
                @endif
                @if (!$certidao_obito)
                    <div class="mb-3">
                        <label for="certidao_obito" class="form-label">Certid??o de ??bito do ??ltimo Sepultado <a
                                class="text-danger"><b>Pendente</b></a></label>
                        <input class="form-control" type="file" name="certidao_obito" id="certidao_obito">
                    </div>
                @endif
                @if (!$inventario_formal_partilha)
                    <div class="mb-3">
                        <label for="inventario_formal_partilha" class="form-label">Invent??rio ou Formal de Partilha,
                            caso o Titular do jazigo
                            seja falecido, de acordo com o art.13 da Lei 1.871 de 21 de janeiro de 1.998 <a
                                class="text-danger"><b>Pendente</b></a></label>
                        <input class="form-control" type="file" name="inventario_formal_partilha"
                            id="inventario_formal_partilha">
                    </div>
                @endif
                @if (!$Doc_Ident_Frente || !$Doc_Ident_Verso || !$cpf || !$comprovante_endereco || !$comprovante_titularidade_jazigo || !$certidao_obito || !$inventario_formal_partilha)
                    <div class="text-center">
                        <button type="submit" class="btn btn-prm">Enviar Documento</button>
                    </div>
                @endif
            </div>
        </div>
    </form>

        {{-- Div para visualizar e ou remover imagens cadastradas --}}
        <div class="col-12 mt-2">
            <div class="col-xl-5 col-lg-10 col-12 mx-auto">
                @if ($documentos)
                    @foreach ($documentos->sortBy('tipo_doc') as $documento)
                        <div class="row mb-2">
                            <div class="col-xl-10 col-lg-10 col-sm-10 col-9">
                                <label for="Doc_Ident_Frente" class="form-label">{{ $documento->nome }} <a
                                        class="text-success"><b>Enviado</b></a></label>
                                <input class="form-control" type="file" disabled>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-sm-2 col-1 p-0 text-center">
                                <a class="btn p-0" data-bs-toggle="modal"
                                    data-bs-target="#documento{{ $documento->id }}_Modal">
                                    <img src="{{ config('app.url', 'http://localhost') }}/{{ $documento->imagem }}"
                                        style="height: 67px; width: 67px; min-height: 67px; min-width: 67px; background-color:aliceblue;" class="img-thumbnail"
                                        alt="...">
                                </a>
                                <br>
                                <a class="btn btn-danger mx-auto" data-bs-toggle="modal"
                                    data-bs-target="#delete{{ $documento->id }}_Modal">Excluir</a>
                            </div>
                            <hr class="mt-2">
                        </div>
    
                        <!-- Modal Imagem -->
                        <div class="modal fade" id="documento{{ $documento->id }}_Modal" tabindex="-1"
                            aria-labelledby="FrenteModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="termosUsoLabel">
                                            {{ $documento->nome }}</h5>
                                        <button type="button" class="btn-close mr-auto" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body mx-auto">
                                        <img src="{{ config('app.url', 'http://localhost') }}/{{ $documento->imagem }}"
                                            class="img-fluid mx-auto" alt="...">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <!-- Modal Delete -->
                        <div class="modal fade" id="delete{{ $documento->id }}_Modal" tabindex="-1"
                            aria-labelledby="FrenteModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="termosUsoLabel">
                                            Excluir {{ $documento->nome }}</h5>
                                        <button type="button" class="btn-close mr-auto" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body mx-auto">
                                        Tem certeza que deseja excluir: {{ $documento->nome }}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <form action="/documento-delete/{{ $documento->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Excluir Documento</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    {{-- Se o usu??rio n??o tem nenhuma informa????o cadastrada aparece o form para cadastrar informa????es --}}
    {{-- @if (!$informacao)
        <form action="salvar-informacoes" method="post">
            @csrf
            <div class="col-12 mt-2">
                <div class="col-xl-5 mb-5 mx-auto">
                    <h5 class="text-center"><strong>Informa????es</strong></h5>
                    <div class="row">
                        <div class="mb-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 p-1">
                            <label for="cemiterio">Cemit??rio</label>
                            <input type="text" class="form-control" value="{{ old('cemiterio') }}" name="cemiterio"
                                id="cemiterio">
                        </div>
                        <div class="mb-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 p-1">
                            <label for="quadra">Quadra</label>
                            <input type="text" class="form-control" value="{{ old('quadra') }}" name="quadra"
                                id="quadra">
                        </div>
                        <div class="mb-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 p-1">
                            <label for="jazigo">Jazigo</label>
                            <input type="text" class="form-control" value="{{ old('jazigo') }}" name="jazigo"
                                id="jazigo">
                        </div>
                        <div class="mb-3 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12 p-1">
                            <label for="nome_permissionario">Nome do Permission??rio *</label>
                            <input type="text" class="form-control  @error('nome_permissionario') is-invalid @enderror"
                                value="{{ old('nome_permissionario') }}" name="nome_permissionario"
                                id="nome_permissionario">
                            @error('nome_permissionario')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 p-1">
                            <label for="permissionario_vivo">O Permission??rio ?? vivo? *</label>
                            <div class="form-check">
                                <input class="form-check-input @error('permissionario_vivo') is-invalid @enderror"
                                    type="radio" name="permissionario_vivo" value="Sim" id="sim_vivo">
                                <label class="form-check-label" for="sim_vivo">
                                    Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input @error('permissionario_vivo') is-invalid @enderror"
                                    type="radio" name="permissionario_vivo" value="N??o" id="nao_vivo">
                                <label class="form-check-label" for="nao_vivo">
                                    N??o
                                </label>
                            </div>
                            @error('permissionario_vivo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 p-1">
                            <label for="manutencao_permissao_jazigo">Tem Interesse na Manuten????o da Permiss??o do Jazigo?
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
                                    type="radio" name="manutencao_permissao_jazigo" value="N??o" id="nao_jazigo">
                                <label class="form-check-label" for="nao_jazigo">
                                    N??o
                                </label>
                            </div>
                            @error('manutencao_permissao_jazigo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button class="btn btn-prm">Salvar Informa????es</button>
                        </div>
                    </div>
                </div>
            </div>
        </form> --}}

    {{-- Se o usu??rio tiver alguma informa????o cadastrada aparece o form para edi????o --}}
    {{-- @else
        <div class="col-12 mt-2">
            <div class="col-xl-5 mb-5 mx-auto">
                <h5 class="text-center"><strong>Informa????es</strong></h5>
                <form action="/editar-informacoes/{{ $informacao->id }}" method="POST">
                    @method("PUT")
                    @csrf
                    <div class="row p-1">
                        <div class="mb-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 p-1">
                            <label for="cemiterio">Cemit??rio</label>
                            <input type="text" class="form-control" value="{{ $informacao->cemiterio }}"
                                name="cemiterio" id="cemiterio">
                        </div>
                        <div class="mb-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 p-1">
                            <label for="quadra">Quadra</label>
                            <input type="text" class="form-control" value="{{ $informacao->quadra }}" name="quadra"
                                id="quadra">
                        </div>
                        <div class="mb-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 p-1">
                            <label for="jazigo">Jazigo</label>
                            <input type="text" class="form-control" value="{{ $informacao->jazigo }}" name="jazigo"
                                id="jazigo">
                        </div>
                        <div class="mb-3 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12 p-1">
                            <label for="nome_permissionario">Nome do Permission??rio *</label>
                            <input type="text" class="form-control  @error('nome_permissionario') is-invalid @enderror"
                                value="{{ $informacao->nome_permissionario }}" name="nome_permissionario"
                                id="nome_permissionario">
                            @error('nome_permissionario')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 p-1">
                            <label for="permissionario_vivo">O Permission??rio ?? vivo? *</label>
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
                                    {{ $informacao->permissionario_vivo == 'N??o' ? 'checked' : '' }} value="N??o"
                                    id="nao_vivo">
                                <label class="form-check-label" for="nao_vivo">
                                    N??o
                                </label>
                            </div>
                            @error('permissionario_vivo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 p-1">
                            <label for="manutencao_permissao_jazigo">Tem Interesse na Manuten????o da Permiss??o do Jazigo?
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
                                    {{ $informacao->manutencao_permissao_jazigo == 'N??o' ? 'checked' : '' }} value="N??o"
                                    id="nao_jazigo">
                                <label class="form-check-label" for="nao_jazigo">
                                    N??o
                                </label>
                            </div>
                            @error('manutencao_permissao_jazigo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button class="btn btn-prm">Editar Informa????es</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif --}}
@endsection

{{-- <script>

let value = document.querySelector('navbarDropdown');
let target = link.getAttribute('value');
window.onload;
console.log(target);
</script> --}}
