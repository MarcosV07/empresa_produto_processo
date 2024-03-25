<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoPessoaRequest;
use App\Http\Requests\UpdateTipoPessoaRequest;
use App\Models\TipoPessoa;

class TipoPessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoPessoas = TipoPessoa::paginate(20);
        return view("tipo-pessoa.index", ["tipoPessoas" => $tipoPessoas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tipo-pessoa.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTipoPessoaRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoPessoaRequest $request)
    {
        TipoPessoa::create($request->all());
        toastr()->success('Tipo de Pessoa cadastrada com sucesso');
        return redirect()->route("tipo-pessoa.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoPessoa  $tipoPessoa
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoPessoa $tipoPessoa)
    {
        return view("tipo-pessoa.create", ["tipoPessoa" => $tipoPessoa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreTipoPessoaRequest $request
     * @param  \App\Models\TipoPessoa $tipoPessoa
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTipoPessoaRequest $request, TipoPessoa $tipoPessoa)
    {
        
        $tipoPessoa->update($request->all());
        toastr()->success('Tipo de Pessoa alterada com sucesso');
        return redirect()->route("tipo-pessoa.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoPessoa $tipoPessoa
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoPessoa $tipoPessoa)
    {
        $tipoPessoa->delete();
        toastr()->success('Tipo de Pessoa excluída com sucesso');
        return redirect()->route("tipo-pessoa.index");
    }
}
