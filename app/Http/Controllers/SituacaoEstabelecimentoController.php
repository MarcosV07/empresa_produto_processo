<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSituacaoEstabelecimentoRequest;
use App\Http\Requests\UpdateSituacaoEstabelecimentoRequest;
use App\Models\SituacaoEstabelecimento;

class SituacaoEstabelecimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $situacaoEstabelecimentos = SituacaoEstabelecimento::paginate(20);
        return view("situacao-estabelecimento.index", ["situacaoEstabelecimentos" => $situacaoEstabelecimentos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("situacao-estabelecimento.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSituacaoEstabelecimentoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSituacaoEstabelecimentoRequest $request)
    {
        SituacaoEstabelecimento::create($request->all());
        toastr()->success('Situação de Estabelecimento cadastrada com sucesso');
        return redirect()->route("situacao-estabelecimento.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SituacaoEstabelecimento  $situacaoEstabelecimento
     * @return \Illuminate\Http\Response
     */
    public function edit(SituacaoEstabelecimento $situacaoEstabelecimento)
    {
        return view("situacao-estabelecimento.create", ["situacaoEstabelecimento" => $situacaoEstabelecimento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreSituacaoEstabelecimentoRequest  $request
     * @param  \App\Models\SituacaoEstabelecimento $situacaoEstabelecimento
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSituacaoEstabelecimentoRequest $request, SituacaoEstabelecimento $situacaoEstabelecimento)
    {
        $situacaoEstabelecimento->update($request->all());
        toastr()->success('Situação de Estabelecimento alterada com sucesso');
        return redirect()->route("situacao-estabelecimento.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SituacaoEstabelecimento $situacaoEstabelecimento
     * @return \Illuminate\Http\Response
     */
    public function destroy(SituacaoEstabelecimento $situacaoEstabelecimento)
    {
        $situacaoEstabelecimento->delete();
        toastr()->success('Situação de Estabelecimento excluída com sucesso');
        return redirect()->route("situacao-estabelecimento.index");
    }
}
