<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Nome da imagem
        $nomeArquivo = null;

        if ($request->hasFile('Doc_Ident_Frente') && $request->file('Doc_Ident_Frente')->isValid()) {
            
            // Coloca um nome aleatório no arquivo baseado no timestamps atual
            $nome = uniqid(date('HisYmd'));

            $extensao = $request->Doc_Ident_Frente->getClientOriginalExtension();

            $nomeArquivo = "{$nome}.{$extensao}";

            $upload = $request->Doc_Ident_Frente->storeAs('Documentos', $nomeArquivo);

            if (!$upload) {
                return "Falhou";
            }
            return "Imagem salva";
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
