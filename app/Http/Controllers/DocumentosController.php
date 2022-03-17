<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InformacaoRequest;
use App\Models\Documento;
use App\Models\User;
use App\Models\Informacao;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use Auth;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class DocumentosController extends Controller
{
    // Função para exibir apenas os usuários completos
    public function completos()
    {
        $tipoUsuario = Auth::user()->tipo;

        if ($tipoUsuario != "A") {
            return redirect('documentos');
        }

        $rota = Route::getCurrentRoute()->getName();

        $usuarios = User::all()->where('tipo', 'U');

        $completos = null;

        $i = 0;

        foreach ($usuarios as $usuario) {

            $usuario->documentos->where('user_id', $usuario->id);

            $informacao = Informacao::where('user_id', $usuario->id);

            if ($informacao->exists()) {

                $usuario->informacoes->where('user_id', $usuario->id);

                if ($usuario->documentos->count() == 7 && $usuario->informacoes->nome_permissionario && $usuario->informacoes->permissionario_vivo && $usuario->informacoes->manutencao_permissao_jazigo) {
                    $completos[$i] = $usuario;
                    $i++;
                }
            }
        }

        return view('dashboard', ['usuarios' => $completos, 'rota' => $rota]);
    }

    // Função para exibir apenas os usuários incompletos
    public function incompletos()
    {
        $tipoUsuario = Auth::user()->tipo;

        if ($tipoUsuario != "A") {
            return redirect('documentos');
        }

        $rota = Route::getCurrentRoute()->getName();

        $usuarios = User::all()->where('tipo', 'U');

        $incompletos = null;

        $i = 0;

        foreach ($usuarios as $usuario) {

            $usuario->documentos->where('user_id', $usuario->id);

            $informacao = Informacao::where('user_id', $usuario->id);

            // Se não tiver 7 documentos ou não tiver nenhuma informação cadastrada
            if ($usuario->documentos->count() < 7 || !$informacao->exists()) {

                $incompletos[$i] = $usuario;
                $i++;
            }
        }

        return view('dashboard', ['usuarios' => $incompletos, 'rota' => $rota]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoUsuario = Auth::user()->tipo;

        if ($tipoUsuario != "A") {
            return redirect('documentos');
        }

        $rota = Route::getCurrentRoute()->getName();

        $usuarios = User::all()->where('tipo', 'U');

        foreach ($usuarios as $usuario) {

            $usuario->documentos->where('user_id', $usuario->id);

            $informacao = Informacao::where('user_id', $usuario->id);

            if ($informacao->exists()) {
                $usuario->informacoes->where('user_id', $usuario->id);
            }
        }

        return view('dashboard', ['usuarios' => $usuarios, 'rota' => $rota]);
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'Usuários.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Pegando o id do usuário logado
        $idUsuario = Auth::user()->id;

        if (Informacao::where('user_id', $idUsuario)->exists()) {
            $informacao = Informacao::where('user_id', $idUsuario)->get();
            $informacao = $informacao[0];
            // return $informacao;
        } else {
            $informacao = null;
        }

        // Verificando se existe algum documento vinculado à aquele usuário
        if (Documento::where('user_id', $idUsuario)->exists()) {

            // Caso existam documentos vinculados atribuimos eles a variável documentos
            $documentos = Documento::where('user_id', $idUsuario)->get();

            // Para cada documento se ele não estiver vazio são inseridos os valores neles
            foreach ($documentos as $documento) {
                if ($documento->where('tipo_doc', 1,)->where('user_id', $idUsuario)->exists()) {
                    $identidadeFrente = $documento->where('tipo_doc', 1)->where('user_id', $idUsuario)->get();
                    $identidadeFrente = $identidadeFrente[0];
                } else {
                    $identidadeFrente = null;
                }
                if ($documento->where('tipo_doc', 2)->where('user_id', $idUsuario)->exists()) {
                    $identidadeVerso = $documento->where('tipo_doc', 2)->where('user_id', $idUsuario)->get();
                    $identidadeVerso = $identidadeVerso[0];
                } else {
                    $identidadeVerso = null;
                }
                if ($documento->where('tipo_doc', 3)->where('user_id', $idUsuario)->where('user_id', $idUsuario)->exists()) {
                    $cpf = $documento->where('tipo_doc', 3)->where('user_id', $idUsuario)->get();
                    $cpf = $cpf[0];
                } else {
                    $cpf = null;
                }
                if ($documento->where('tipo_doc', 4)->where('user_id', $idUsuario)->exists()) {
                    $comprovanteEndereco = $documento->where('tipo_doc', 4)->where('user_id', $idUsuario)->get();
                    $comprovanteEndereco = $comprovanteEndereco[0];
                } else {
                    $comprovanteEndereco = null;
                }
                if ($documento->where('tipo_doc', 5)->where('user_id', $idUsuario)->exists()) {
                    $comprovanteTitularidadeJazigo = $documento->where('tipo_doc', 5)->where('user_id', $idUsuario)->get();
                    $comprovanteTitularidadeJazigo = $comprovanteTitularidadeJazigo[0];
                } else {
                    $comprovanteTitularidadeJazigo = null;
                }
                if ($documento->where('tipo_doc', 6)->where('user_id', $idUsuario)->exists()) {
                    $certidaoObito = $documento->where('tipo_doc', 6)->where('user_id', $idUsuario)->get();
                    $certidaoObito = $certidaoObito[0];
                } else {
                    $certidaoObito = null;
                }
                if ($documento->where('tipo_doc', 7)->where('user_id', $idUsuario)->exists()) {
                    $inventarioFormalPartilha = $documento->where('tipo_doc', 7)->where('user_id', $idUsuario)->get();
                    $inventarioFormalPartilha = $inventarioFormalPartilha[0];
                } else {
                    $inventarioFormalPartilha = null;
                }
            }
        } else {
            $documentos = null;
            $identidadeFrente = null;
            $identidadeVerso = null;
            $cpf = null;
            $comprovanteEndereco = null;
            $comprovanteTitularidadeJazigo = null;
            $certidaoObito = null;
            $inventarioFormalPartilha = null;
        }
        return view(
            'documentos',
            [
                'documentos' => $documentos,
                'Doc_Ident_Frente' => $identidadeFrente,
                'Doc_Ident_Verso' => $identidadeVerso,
                'cpf' => $cpf,
                'comprovante_endereco' => $comprovanteEndereco,
                'comprovante_titularidade_jazigo' => $comprovanteTitularidadeJazigo,
                'certidao_obito' => $certidaoObito,
                'inventario_formal_partilha' => $inventarioFormalPartilha,
                'informacao' => $informacao,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cpf = Auth::user()->CPF;
        $cpf = str_replace(".", "", $cpf);
        $path = str_replace("-", "", $cpf);

        // Nome da imagem
        $nomeArquivo = null;

        if ($request->hasFile('Doc_Ident_Frente') && $request->file('Doc_Ident_Frente')->isValid()) {

            // Coloca um nome aleatório no arquivo baseado no timestamps atual
            $nome = uniqid(date('HisYmd'));

            $extensao = $request->Doc_Ident_Frente->getClientOriginalExtension();

            $nomeArquivo = "{$nome}.{$extensao}";

            $upload = $request->Doc_Ident_Frente->storeAs("public/" . $path, $nomeArquivo);

            if (!$upload) {
                return "Falhou";
            }

            $tipo = 1;
            $user = Auth::user();
            $arq = str_replace("public", "storage", $upload);

            $doc = Documento::create([
                'user_id' => $user->id,
                'tipo_doc' => $tipo,
                'imagem' => $arq,
                'nome' => "Documento de Identificação Frente",
            ]);

            if (
                !$request->hasFile('Doc_Ident_Verso') &&
                !$request->hasFile('cpf') &&
                !$request->hasFile('comprovante_endereco') &&
                !$request->hasFile('comprovante_titularidade_jazigo') &&
                !$request->hasFile('certidao_obito') &&
                !$request->hasFile('inventario_formal_partilha')
            ) {
                return redirect('documentos');
            }
        }

        if ($request->hasFile('Doc_Ident_Verso') && $request->file('Doc_Ident_Verso')->isValid()) {

            // Coloca um nome aleatório no arquivo baseado no timestamps atual
            $nome = uniqid(date('HisYmd'));

            $extensao = $request->Doc_Ident_Verso->getClientOriginalExtension();

            $nomeArquivo = "{$nome}.{$extensao}";

            $upload = $request->Doc_Ident_Verso->storeAs("public/" . $path, $nomeArquivo);

            if (!$upload) {
                return "Falhou";
            }
            $tipo = 2;
            $user = Auth::user();
            $arq = str_replace("public", "storage", $upload);

            $doc = Documento::create([
                'user_id' => $user->id,
                'tipo_doc' => $tipo,
                'imagem' => $arq,
                'nome' => "Documento de Identificação Verso",
            ]);

            if (
                !$request->hasFile('cpf') &&
                !$request->hasFile('comprovante_endereco') &&
                !$request->hasFile('comprovante_titularidade_jazigo') &&
                !$request->hasFile('certidao_obito') &&
                !$request->hasFile('inventario_formal_partilha')
            ) {
                return redirect('documentos');
            }
        }

        if ($request->hasFile('cpf') && $request->file('cpf')->isValid()) {

            // Coloca um nome aleatório no arquivo baseado no timestamps atual
            $nome = uniqid(date('HisYmd'));

            $extensao = $request->cpf->getClientOriginalExtension();

            $nomeArquivo = "{$nome}.{$extensao}";

            $upload = $request->cpf->storeAs("public/" . $path, $nomeArquivo);

            if (!$upload) {
                return "Falhou";
            }
            $tipo = 3;
            $user = Auth::user();
            $arq = str_replace("public", "storage", $upload);

            $doc = Documento::create([
                'user_id' => $user->id,
                'tipo_doc' => $tipo,
                'imagem' => $arq,
                'nome' => "CPF",
            ]);

            if (
                !$request->hasFile('comprovante_endereco') &&
                !$request->hasFile('comprovante_titularidade_jazigo') &&
                !$request->hasFile('certidao_obito') &&
                !$request->hasFile('inventario_formal_partilha')
            ) {
                return redirect('documentos');
            }
        }

        if ($request->hasFile('comprovante_endereco') && $request->file('comprovante_endereco')->isValid()) {

            // Coloca um nome aleatório no arquivo baseado no timestamps atual
            $nome = uniqid(date('HisYmd'));

            $extensao = $request->comprovante_endereco->getClientOriginalExtension();

            $nomeArquivo = "{$nome}.{$extensao}";

            $upload = $request->comprovante_endereco->storeAs("public/" . $path, $nomeArquivo);

            if (!$upload) {
                return "Falhou";
            }
            $tipo = 4;
            $user = Auth::user();
            $arq = str_replace("public", "storage", $upload);

            $doc = Documento::create([
                'user_id' => $user->id,
                'tipo_doc' => $tipo,
                'imagem' => $arq,
                'nome' => "Comprovante de Endereço",
            ]);

            if (
                !$request->hasFile('comprovante_titularidade_jazigo') &&
                !$request->hasFile('certidao_obito') &&
                !$request->hasFile('inventario_formal_partilha')
            ) {
                return redirect('documentos');
            }
        }
        if ($request->hasFile('comprovante_titularidade_jazigo') && $request->file('comprovante_titularidade_jazigo')->isValid()) {

            // Coloca um nome aleatório no arquivo baseado no timestamps atual
            $nome = uniqid(date('HisYmd'));

            $extensao = $request->comprovante_titularidade_jazigo->getClientOriginalExtension();

            $nomeArquivo = "{$nome}.{$extensao}";

            $upload = $request->comprovante_titularidade_jazigo->storeAs("public/" . $path, $nomeArquivo);

            if (!$upload) {
                return "Falhou";
            }
            $tipo = 5;
            $user = Auth::user();
            $arq = str_replace("public", "storage", $upload);

            $doc = Documento::create([
                'user_id' => $user->id,
                'tipo_doc' => $tipo,
                'imagem' => $arq,
                'nome' => "Comprovante de Titularidade de Jazigo",
            ]);

            if (
                !$request->hasFile('certidao_obito') &&
                !$request->hasFile('inventario_formal_partilha')
            ) {
                return redirect('documentos');
            }
        }
        if ($request->hasFile('certidao_obito') && $request->file('certidao_obito')->isValid()) {

            // Coloca um nome aleatório no arquivo baseado no timestamps atual
            $nome = uniqid(date('HisYmd'));

            $extensao = $request->certidao_obito->getClientOriginalExtension();

            $nomeArquivo = "{$nome}.{$extensao}";

            $upload = $request->certidao_obito->storeAs("public/" . $path, $nomeArquivo);

            if (!$upload) {
                return "Falhou";
            }
            $tipo = 6;
            $user = Auth::user();
            $arq = str_replace("public", "storage", $upload);

            $doc = Documento::create([
                'user_id' => $user->id,
                'tipo_doc' => $tipo,
                'imagem' => $arq,
                'nome' => "Certidão de Óbito",
            ]);

            if (
                !$request->hasFile('inventario_formal_partilha')
            ) {
                return redirect('documentos');
            }
        }
        if ($request->hasFile('inventario_formal_partilha') && $request->file('inventario_formal_partilha')->isValid()) {

            // Coloca um nome aleatório no arquivo baseado no timestamps atual
            $nome = uniqid(date('HisYmd'));

            $extensao = $request->inventario_formal_partilha->getClientOriginalExtension();

            $nomeArquivo = "{$nome}.{$extensao}";

            $upload = $request->inventario_formal_partilha->storeAs("public/" . $path, $nomeArquivo);

            if (!$upload) {
                return "Falhou";
            }
            $tipo = 7;
            $user = Auth::user();
            $arq = str_replace("public", "storage", $upload);

            $doc = Documento::create([
                'user_id' => $user->id,
                'tipo_doc' => $tipo,
                'imagem' => $arq,
                'nome' => "Inventário ou Formal de Partilha",
            ]);

            return redirect('documentos');
        }
    }

    // Função para adicionar informações
    public function salvarInformacoes(InformacaoRequest $request)
    {
        $user_id = Auth::user()->id;
        // return $user_id;

        $informacao = Informacao::create([
            'cemiterio' => $request->cemiterio,
            'quadra' => $request->quadra,
            'jazigo' => $request->jazigo,
            'nome_permissionario' => $request->nome_permissionario,
            'permissionario_vivo' => $request->permissionario_vivo,
            'manutencao_permissao_jazigo' => $request->manutencao_permissao_jazigo,
            'user_id' => $user_id,
        ]);

        return redirect('documentos');
    }

    // Função para editar informações
    public function editarInformacoes(InformacaoRequest $request, $id)
    {
        $informacao = Informacao::find($id);

        $informacao->update($request->all());

        return redirect('documentos')->with("success", "Informações editadas com sucesso");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Buscando o documento com o Id Recebido
        $documento = Documento::find($id);

        // Usando isso para remover o Storage do caminho da imagem
        $nome =  substr($documento->imagem, 8);

        // Aqui a gente defina que está buscando a pasta public dentro de storage
        // O resto do caminho e o nome da imagem estão na variável nome
        Storage::disk('public')->delete($nome);

        $documento->delete();

        return redirect('documentos');
    }
}
