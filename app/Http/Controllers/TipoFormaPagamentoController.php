<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoFormaPagamentoRequest;
use App\Http\Requests\UpdateTipoFormaPagamentoRequest;
use App\Models\TipoFormaPagamento;

class TipoFormaPagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoFormaPagamentos = TipoFormaPagamento::paginate(20);
        return view("tipo-forma-pagamento.index", ["tipoFormaPagamentos" => $tipoFormaPagamentos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tipo-forma-pagamento.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTipoFormaPagamentoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoFormaPagamentoRequest $request)
    {
        TipoFormaPagamento::create($request->all());
        toastr()->success('Tipo de Forma de Pagamento cadastrado com sucesso');
        return redirect()->route("tipo-forma-pagamento.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoFormaPagamento $tipoFormaPagamento
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoFormaPagamento $tipoFormaPagamento)
    {
        return view("tipo-forma-pagamento.create", ["tipoFormaPagamento" => $tipoFormaPagamento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreTipoFormaPagamentoRequest $request
     * @param  \App\Models\TipoFormaPagamento $tipoFormaPagamento
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTipoFormaPagamentoRequest $request, TipoFormaPagamento $tipoFormaPagamento)
    {
        $tipoFormaPagamento->update($request->all());
        toastr()->success('Tipo de Forma de Pagamento alterado com sucesso');
        return redirect()->route("tipo-forma-pagamento.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoFormaPagamento $tipoFormaPagamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoFormaPagamento $tipoFormaPagamento)
    {
        $tipoFormaPagamento->delete();
        toastr()->success('Tipo de Forma de Pagamento excluído com sucesso');
        return redirect()->route("tipo-forma-pagamento.index");
    }
}
