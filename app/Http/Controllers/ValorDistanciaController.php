<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreValorDistanciaRequest;
use App\Http\Requests\UpdateValorDistanciaRequest;
use App\Models\ValorDistancia;

class ValorDistanciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $valorDistancias = ValorDistancia::paginate(20);
        return view("valor-distancia.index", ["valorDistancias" => $valorDistancias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("valor-distancia.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreValorDistanciaRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreValorDistanciaRequest $request)
    {
        ValorDistancia::create($request->all());
        toastr()->success('Valor Distância cadastrado com sucesso');
        return redirect()->route("valor-distancia.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ValorDistancia $valorDistancia
     * @return \Illuminate\Http\Response
     */
    public function edit(ValorDistancia $valorDistancia)
    {
        $valorDistancia->valor = floatToMoney($valorDistancia->valor);
        return view("valor-distancia.create", ["valorDistancia" => $valorDistancia]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreValorDistanciaRequest $request
     * @param  \App\Models\ValorDistancia $valorDistancia
     * @return \Illuminate\Http\Response
     */
    public function update(StoreValorDistanciaRequest $request, ValorDistancia $valorDistancia)
    {
        $valorDistancia->update($request->all());
        toastr()->success('Valor Distância alterado com sucesso');
        return redirect()->route("valor-distancia.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ValorDistancia $valorDistancia
     * @return \Illuminate\Http\Response
     */
    public function destroy(ValorDistancia $valorDistancia)
    {
        $valorDistancia->delete();
        toastr()->success('Valor Distância excluído com sucesso');
        return redirect()->route("valor-distancia.index");
    }
}
