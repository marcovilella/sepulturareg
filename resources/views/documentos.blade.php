@extends('layout')
@section('secao')
    <nav class="navbar navbar-expand-lg navbar-light bg-prm">
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
                        <a class="text-white nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
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

    <form action="/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-12 mt-5">
            <div class="col-xl-5 p-5 mx-auto">
                <div class="mb-3">
                    @if (!$Doc_Ident_Frente)
                        <label for="Doc_Ident_Frente" class="form-label">Documento de Identificação Frente <a
                                class="text-danger"><b>Pendente</b></a></label>
                        <input class="form-control" type="file" name="Doc_Ident_Frente" id="Doc_Ident_Frente">
                    @else
                        <div class="text-center">
                            <a class="btn" data-bs-toggle="modal" data-bs-target="#Doc_Ident_Frente_Modal">
                                Documento de Identificação Frente <br>
                                <img src="{{ config('app.url', 'http://localhost') }}/{{ $Doc_Ident_Frente->imagem }}"
                                    style="height: 67px; width: 67px; background-color:aliceblue;" class="img-thumbnail"
                                    alt="...">
                            </a>
                            <br>
                            <a class="btn btn-danger">Remover Imagem</a>
                        </div>
                        <!-- Modal Identidade Frente -->
                        <div class="modal fade" id="Doc_Ident_Frente_Modal" tabindex="-1"
                            aria-labelledby="FrenteModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="termosUsoLabel">{{ $Doc_Ident_Frente->nome }}</h5>
                                        <button type="button" class="btn-close mr-auto" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body mx-auto">
                                        <img src="{{ config('app.url', 'http://localhost') }}/{{ $Doc_Ident_Frente->imagem }}"
                                            class="img-fluid mx-auto" alt="...">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Fechar</button>
                                        <a class="btn btn-danger">Remover Imagem</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    @if (!$Doc_Ident_Verso)
                        <label for="Doc_Ident_Verso" class="form-label">Documento de Identificação Verso <a
                                class="text-danger"><b>Pendente</b></a></label>
                        <input class="form-control" type="file" name="Doc_Ident_Verso" id="Doc_Ident_Verso">
                    @else
                        <div class="text-center">
                            <a class="btn" data-bs-toggle="modal" data-bs-target="#Doc_Ident_Verso_Modal">
                                Documento de Identificação Verso <br>
                                <img src="{{ config('app.url', 'http://localhost') }}/{{ $Doc_Ident_Verso->imagem }}"
                                    style="height: 67px; width: 67px; background-color:aliceblue;" class="img-thumbnail"
                                    alt="...">
                            </a>
                            <br>
                            <a class="btn btn-danger">Remover Imagem</a>
                        </div>

                        <!-- Modal Identidade Verso -->
                        <div class="modal fade" id="Doc_Ident_Verso_Modal" tabindex="-1"
                            aria-labelledby="VersoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="termosUsoLabel">{{ $Doc_Ident_Verso->nome }}</h5>
                                        <button type="button" class="btn-close mr-auto" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body mx-auto">
                                        <img src="{{ config('app.url', 'http://localhost') }}/{{ $Doc_Ident_Verso->imagem }}"
                                            class="img-fluid mx-auto" alt="...">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Fechar</button>
                                        <a class="btn btn-danger">Remover Imagem</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    @if (!$cpf)
                        <label for="cpf" class="form-label">CPF <a class="text-danger"><b>Pendente</b></a></label>
                        <input class="form-control" type="file" name="cpf" id="cpf">
                    @else
                        <div class="text-center">
                            <a class="btn" data-bs-toggle="modal" data-bs-target="#cpf_Modal">
                                CPF <br>
                                <img src="{{ config('app.url', 'http://localhost') }}/{{ $cpf->imagem }}"
                                    style="height: 67px; width: 67px; background-color:aliceblue;" class="img-thumbnail"
                                    alt="...">
                            </a>
                            <br>
                            <a class="btn btn-danger">Remover Imagem</a>
                        </div>
                        <!-- Modal CPF -->
                        <div class="modal fade" id="cpf_Modal" tabindex="-1" aria-labelledby="cpfModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="termosUsoLabel">{{ $cpf->nome }}</h5>
                                        <button type="button" class="btn-close mr-auto" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body mx-auto">
                                        <img src="{{ config('app.url', 'http://localhost') }}/{{ $cpf->imagem }}"
                                            class="img-fluid mx-auto" alt="...">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Fechar</button>
                                        <a class="btn btn-danger">Remover Imagem</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    @if (!$comprovante_endereco)
                        <label for="comprovante_endereco" class="form-label">Comprovante de Endereço <a
                                class="text-danger"><b>Pendente</b></a></label>
                        <input class="form-control" type="file" name="comprovante_endereco" id="comprovante_endereco">
                    @else
                        <div class="text-center">
                            <a class="btn" data-bs-toggle="modal" data-bs-target="#comprovante_endereco_Modal">
                                Comprovante de Endereço <br>
                                <img src="{{ config('app.url', 'http://localhost') }}/{{ $comprovante_endereco->imagem }}"
                                    style="height: 67px; width: 67px; background-color:aliceblue;" class="img-thumbnail"
                                    alt="{{ $comprovante_endereco->nome }}">
                            </a>
                            <br>
                            <a class="btn btn-danger">Remover Imagem</a>
                        </div>
                        <!-- Modal Comprovante de endereço -->
                        <div class="modal fade" id="comprovante_endereco_Modal" tabindex="-1"
                            aria-labelledby="comprovanteEnderecoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="termosUsoLabel">{{ $comprovante_endereco->nome }}
                                        </h5>
                                        <button type="button" class="btn-close mr-auto" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body mx-auto">
                                        <img src="{{ config('app.url', 'http://localhost') }}/{{ $comprovante_endereco->imagem }}"
                                            class="img-fluid mx-auto" alt="...">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Fechar</button>
                                        <a class="btn btn-danger">Remover Imagem</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    @if (!$comprovante_titularidade_jazigo)
                        <label for="comprovante_titularidade_jazigo" class="form-label">Comprovante de Titularidade de
                            Jazigo <a class="text-danger"><b>Pendente</b></a></label>
                        <input class="form-control" type="file" name="comprovante_titularidade_jazigo"
                            id="comprovante_titularidade_jazigo">
                    @else
                        <div class="text-center">
                            <a class="btn" data-bs-toggle="modal"
                                data-bs-target="#comprovante_titularidade_jazigo_Modal">
                                Comprovante de Titularidade de Jazigo <br>
                                <img src="{{ config('app.url', 'http://localhost') }}/{{ $comprovante_titularidade_jazigo->imagem }}"
                                    style="height: 67px; width: 67px; background-color:aliceblue;" class="img-thumbnail"
                                    alt="...">
                            </a>
                            <br>
                            <a class="btn btn-danger">Remover Imagem</a>
                        </div>
                        <!-- Modal Comprovante de Titularidade ou Jazigo -->
                        <div class="modal fade" id="comprovante_titularidade_jazigo_Modal" tabindex="-1"
                            aria-labelledby="comprovanteTitularidadeJazigoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="termosUsoLabel">
                                            {{ $comprovante_titularidade_jazigo->nome }}</h5>
                                        <button type="button" class="btn-close mr-auto" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body mx-auto">
                                        <img src="{{ config('app.url', 'http://localhost') }}/{{ $comprovante_titularidade_jazigo->imagem }}"
                                            class="img-fluid mx-auto" alt="...">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Fechar</button>
                                        <a class="btn btn-danger">Remover Imagem</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    @if (!$certidao_obito)
                        <label for="certidao_obito" class="form-label">Certidão de Óbito do Último Sepultado <a
                                class="text-danger"><b>Pendente</b></a></label>
                        <input class="form-control" type="file" name="certidao_obito" id="certidao_obito">
                    @else
                        <div class="text-center">
                            <a class="btn" data-bs-toggle="modal" data-bs-target="#certidao_obito_Modal">
                                Certidão de Óbito do Último Sepultado <br>
                                <img src="{{ config('app.url', 'http://localhost') }}/{{ $certidao_obito->imagem }}"
                                    style="height: 67px; width: 67px; background-color:aliceblue;" class="img-thumbnail"
                                    alt="...">
                            </a>
                            <br>
                            <a class="btn btn-danger">Remover Imagem</a>
                        </div>
                        <!-- Modal Certidão de Óbito -->
                        <div class="modal fade" id="certidao_obito_Modal" tabindex="-1"
                            aria-labelledby="certidaoObitoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="termosUsoLabel">{{ $certidao_obito->nome }}</h5>
                                        <button type="button" class="btn-close mr-auto" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body mx-auto">
                                        <img src="{{ config('app.url', 'http://localhost') }}/{{ $certidao_obito->imagem }}"
                                            class="img-fluid mx-auto" alt="...">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Fechar</button>
                                        <a class="btn btn-danger">Remover Imagem</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    @if (!$inventario_formal_partilha)
                        <label for="inventario_formal_partilha" class="form-label">Inventário ou Formal de Partilha,
                            caso o Titular do jazigo
                            seja falecido, de acordo com o art.13 da Lei 1.871 de 21 de janeiro de 1.998 <a
                                class="text-danger"><b>Pendente</b></a></label>
                        <input class="form-control" type="file" name="inventario_formal_partilha"
                            id="inventario_formal_partilha">
                    @else
                        <div class="text-center">
                            <a class="btn" data-bs-toggle="modal"
                                data-bs-target="#inventario_formal_partilha_Modal">
                                Inventário ou Formal de Partilha <br>
                                <img src="{{ config('app.url', 'http://localhost') }}/{{ $inventario_formal_partilha->imagem }}"
                                    style="height: 67px; width: 67px; background-color:aliceblue;" class="img-thumbnail"
                                    alt="...">
                            </a>
                            <br>
                            <a class="btn btn-danger">Remover Imagem</a>
                        </div>
                        <!-- Modal Inventário Formal ou Partilha -->
                        <div class="modal fade" id="inventario_formal_partilha_Modal" tabindex="-1"
                            aria-labelledby="inventarioFormalPartilhaModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="termosUsoLabel">
                                            {{ $inventario_formal_partilha->nome }}</h5>
                                        <button type="button" class="btn-close mr-auto" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body mx-auto">
                                        <img src="{{ config('app.url', 'http://localhost') }}/{{ $inventario_formal_partilha->imagem }}"
                                            class="img-fluid mx-auto" alt="...">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Fechar</button>
                                        <a class="btn btn-danger">Remover Imagem</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @if (!$Doc_Ident_Frente || !$Doc_Ident_Verso || !$cpf || !$comprovante_endereco || !$comprovante_titularidade_jazigo || !$certidao_obito || !$inventario_formal_partilha)
                    <div class="text-center">
                        <button type="submit" class="btn bg-prm">Enviar</button>
                    </div>
                @endif
            </div>
        </div>
    </form>
@endsection
