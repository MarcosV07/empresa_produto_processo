<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTelaRequest;
use App\Http\Requests\UpdateTelaRequest;
use App\Models\Tela;
use App\Models\Modulo;

class TelaController extends Controller
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
        $telas = Tela::with("modulo")->orderBy("created_at", "desc")->paginate(20);
        return view("tela.index", ["telas" => $telas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modulos = Modulo::all();
        return view("tela.create", ["modulos" => $modulos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTelaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTelaRequest $request)
    {
        $parametros = $request->all();
        $parametros["menu"] = ((isset($parametros["menu"]) && $parametros["menu"] === "on") ? true : false);
        $parametros["auditoria"] = ((isset($parametros["auditoria"]) && $parametros["auditoria"] === "on") ? true : false);
        Tela::create($parametros);
        toastr()->success('Tela cadastrada com sucesso');
        return redirect()->route("tela.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tela  $tela
     * @return \Illuminate\Http\Response
     */
    public function edit(Tela $tela)
    {
        $modulos = Modulo::all();
        return view("tela.create", ["tela" => $tela, "modulos" => $modulos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTelaRequest  $request
     * @param  \App\Models\Tela  $tela
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTelaRequest $request, Tela $tela)
    {
        $parametros = $request->all();
        $parametros["menu"] = ((isset($parametros["menu"]) && $parametros["menu"] === "on") ? true : false);
        $parametros["auditoria"] = ((isset($parametros["auditoria"]) && $parametros["auditoria"] === "on") ? true : false);
        $tela->update($parametros);
        toastr()->success('Tela alterada com sucesso');
        return redirect()->route("tela.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tela  $tela
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tela $tela)
    {
        $tela->delete();
        toastr()->success('Tela excluída com sucesso');
        return redirect()->route("tela.index");
    }
}
