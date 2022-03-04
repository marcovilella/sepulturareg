@extends('layout')

<form action="">
    <div class="col-12">
        <div class="col-xl-5 p-5 my-5 bg-light mx-auto">
            <div class="mb-3">
                <div class="">
                    <a class="btn" data-bs-toggle="modal" data-bs-target="#imagemModal">
                        <img src="{{ config('app.url', 'http://localhost') }}/assets/imgs/adicionar-imagem.png"
                            style="height: 67px; width: 67px; background-color:aliceblue;" class="img-thumbnail"
                            alt="...">
                    </a>
                </div>
                <label for="Doc_Ident_Frente" class="form-label">Documento de Identificação Frente</label>
                <input class="form-control" type="file" name="Doc_Ident_Frente" id="Doc_Ident_Frente">
            </div>
            <div class="mb-3">
                <label for="Doc_Ident_Verso" class="form-label">Documento de Identificação Verso</label>
                <input class="form-control" type="file" name="Doc_Ident_Verso" id="Doc_Ident_Verso">
            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input class="form-control" type="file" name="cpf" id="cpf">
            </div>
            <div class="mb-3">
                <label for="comprovante_endereco" class="form-label">Comprovante de Endereço</label>
                <input class="form-control" type="file" name="comprovante_endereco" id="comprovante_endereco">
            </div>
            <div class="mb-3">
                <label for="comprovante_titularidade_jazigo" class="form-label">Comprovante de Titularidade de
                    Jazigo</label>
                <input class="form-control" type="file" name="comprovante_titularidade_jazigo"
                    id="comprovante_titularidade_jazigo">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Certidão de Óbito do Último Sepultado</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Inventário ou Formal de Partilha, caso o Titular do jazigo
                    seja falecido, de acordo com o art.13 da Lei 1.871 de 21 de janeiro de 1.998</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <button type="submit" class="btn">teste </button>
        </div>
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="imagemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close mr-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <img src="{{ config('app.url', 'http://localhost') }}/assets/imgs/adicionar-imagem.png"
                    class="img-fluid" alt="...">
            </div>
        </div>
    </div>
</div>
