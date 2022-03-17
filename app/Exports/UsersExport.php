<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Documento;
use App\Models\Informacao;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            "Id", "Nome Completo", "Email", "Documento de Identificação",
            "CPF", "Celular", "Telefone Fixo", "Whatsapp / Telegram", "Endereço",
            "Numero", "Complemento", "Bairro", "Cidade", "Estado", "CEP", "Status", "Documento de Identificação Frente",
            "Documento de Identificação Verso", "CPF", "Comprovante de Endereço", 
            "Comprovante de Titularidade de Jazigo", "Certidão de Óbito", "Inventário ou Formal de Partilha",
            "Cemitério", "Quadra", "Jazigo", "Nome do Permissionário", "O Permissionário é Vivo?", "Tem Interesse Na Manutenção da Permissão do Jazigo?"
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Nesta linha estamos buscando todos usuários e os dados das tabelas vinculadas à eles
        $usuarios = User::with('documentos')->with('informacoes')->where('tipo', 'U')->select(['users.id', 'users.name', 'users.email', 'users.Doc_Ident', 'users.CPF', 'users.celular', 'users.fixo', 'users.whats_tele', 'users.endereco', 'users.numero', 'users.complemento', 'users.bairro', 'users.cidade', 'users.estado', 'users.cep'])->get();

        foreach ($usuarios as $usuario) {

            $documentos = Documento::all()->where("user_id", $usuario->id);

            $informacoes = Informacao::all()->where("user_id", $usuario->id);

            $informacao = Informacao::where('user_id', $usuario->id);            

            // Adicionando status completo ao resultado dos usuários
            if ($informacao->exists()) {
                $usuario->informacoes->where('user_id', $usuario->id);

                if ($usuario->documentos->where('user_id', $usuario->id)->count() > 6 && $usuario->informacoes->nome_permissionario && $usuario->informacoes->permissionario_vivo && $usuario->informacoes->manutencao_permissao_jazigo) {
                    $usuario->status = "Completo";
                }
            }

            // Adicionando status incompleto ao resultado dos usuários
            if ($usuario->documentos->where('user_id', $usuario->id)->count() < 7  || !$informacao->exists()) {
                $usuario->status = "Incompleto";

            }

            // Adicionando Documentos Enviado ou Pendente
            foreach ($documentos as $documento) {

                if ($documento->where("user_id", $usuario->id)->where("tipo_doc", 1)->exists()) {
                    $usuario->identificacao_frente = "Enviado";
                } else {
                    $usuario->identificacao_frente = "Pendente";
                }
                if ($documento->where("user_id", $usuario->id)->where("tipo_doc", 2)->exists()) {
                    $usuario->identificacao_verso = "Enviado";
                } else {
                    $usuario->identificacao_verso = "Pendente";
                }
                if ($documento->where("user_id", $usuario->id)->where("tipo_doc", 3)->exists()) {
                    $usuario->cpf = "Enviado";
                } else {
                    $usuario->cpf = "Pendente";
                }
                if ($documento->where("user_id", $usuario->id)->where("tipo_doc", 4)->exists()) {
                    $usuario->comprovante_endereco = "Enviado";
                } else {
                    $usuario->comprovante_endereco = "Pendente";
                }
                if ($documento->where("user_id", $usuario->id)->where("tipo_doc", 5)->exists()) {
                    $usuario->comprovante_titularidade_jazigo = "Enviado";
                } else {
                    $usuario->comprovante_titularidade_jazigo = "Pendente";
                }
                if ($documento->where("user_id", $usuario->id)->where("tipo_doc", 6)->exists()) {
                    $usuario->certidao_obito = "Enviado";
                } else {
                    $usuario->certidao_obito = "Pendente";
                }
                if ($documento->where("user_id", $usuario->id)->where("tipo_doc", 7)->exists()) {
                    $usuario->inventario_formal_partilha = "Enviado";
                } else {
                    $usuario->inventario_formal_partilha = "Pendente";
                }
            }

            // Adicionando as informações dos usuários
            if ($informacoes->where('user->id', $usuario->id)) {
                foreach ($informacoes as $informacao) {
                    $usuario->informacoes->where('user->id', $usuario->id);

                    $usuario->cemiterio = $informacao->cemiterio;
                    $usuario->quadra = $informacao->quadra;
                    $usuario->jazigo = $informacao->jazigo;
                    $usuario->nome_permissionario = $informacao->nome_permissionario;
                    $usuario->permissionario_vivo = $informacao->permissionario_vivo;
                    $usuario->manutencao_permissao_jazigo = $informacao->manutencao_permissao_jazigo;
                }
            }
        }
        return $usuarios;
    }
}
