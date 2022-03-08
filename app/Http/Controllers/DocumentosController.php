<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Documento;

class DocumentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idUsuario = Auth::user()->id;
        $documentos = Documento::where('user_id', $idUsuario)->get();
        $identidadeFrente = $documentos->where('tipo_doc', 1);
        echo $identidadeFrente;
        // $identidadeFrente = null;
        $identidadeVerso = null;
        $cpf = null;
        $comprovanteEndereco = null;
        $comprovanteTitularidadeJazigo = null;
        $certidaoObito = null;
        $inventarioFormalPartilha = null;
        return view(
            'documentos',
            [
                // 'documentos' => $documentos,
                'Doc_Ident_Frente' => null,
                'Doc_Ident_Verso' => $identidadeVerso,
                'cpf' => $cpf,
                'comprovante_endereco' => $comprovanteEndereco,
                'comprovante_titularidade_jazigo' => $comprovanteTitularidadeJazigo,
                'certidao_obito' => $certidaoObito,
                'inventario_formal_partilha' => $inventarioFormalPartilha
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
            // return view('documentos', ['images' => $doc]);
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
            // return view('documentos', ['images' => $doc]);
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
            // return view('documentos', ['images' => $doc]);
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
            // return view('documentos', ['images' => $doc]);
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
            // return view('documentos', ['images' => $doc]);
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
            // return view('documentos', ['images' => $doc]);
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
            // return view('documentos', ['images' => $doc]);
                return redirect('documentos');
        }
        echo "Nenhuma imagem";
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
        //
    }
}
