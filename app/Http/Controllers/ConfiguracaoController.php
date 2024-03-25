<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConfiguracaoRequest;
use App\Http\Requests\UpdateConfiguracaoRequest;
use App\Models\Configuracao;

class ConfiguracaoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configuracoes = Configuracao::paginate(20);
        return view("configuracao.index", ["configuracoes" => $configuracoes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("configuracao.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreConfiguracaoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConfiguracaoRequest $request)
    {
        Configuracao::create($request->all());
        toastr()->success('Configurações cadastrada com sucesso');
        return redirect()->route("configuracao.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Configuracao $configuracao
     * @return \Illuminate\Http\Response
     */
    public function edit(Configuracao $configuracao)
    {
        return view("configuracao.create", ["configuracao" => $configuracao]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreConfiguracaoRequest $request
     * @param  \App\Models\Configuracao $Configuracao
     * @return \Illuminate\Http\Response
     */
    public function update(StoreConfiguracaoRequest $request, Configuracao $configuracao)
    {
        $configuracao->update($request->all());
        toastr()->success('Configuração alterada com sucesso');
        return redirect()->route("configuracao.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Configuracao $configuracao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuracao $configuracao)
    {
        $configuracao->delete();
        toastr()->success('Configuração excluída com sucesso');
        return redirect()->route("configuracao.index");
    }
}
