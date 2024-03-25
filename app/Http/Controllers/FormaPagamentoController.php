<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormaPagamentoRequest;
use App\Http\Requests\UpdateFormaPagamentoRequest;
use App\Models\FormaPagamento;
use App\Models\TipoFormaPagamento;
use Illuminate\Support\Facades\Storage;

class FormaPagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formaPagamentos = FormaPagamento::with("tipoFormaPagamento")->paginate(20);
        return view("forma-pagamento.index", ["formaPagamentos" => $formaPagamentos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoFormaPagamentos = TipoFormaPagamento::all();
        return view("forma-pagamento.create", ["tipoFormaPagamentos" => $tipoFormaPagamentos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFormaPagamentoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFormaPagamentoRequest $request)
    {
        $parametros = $request->all();
        if($request->hasFile("arquivo") && $request->file("arquivo")->isValid()) {
            $caminho = $this->obterValorConfiguracao("CAMINHO_IMAGENS_FORMAS_PAGAMENTO");
            $foto = Storage::disk('public')->putFile($caminho, $request->file('arquivo'));
            $parametros["foto"] = $foto;
        }

        FormaPagamento::create($parametros);
        toastr()->success('Forma de Pagamento cadastrado com sucesso');
        return redirect()->route("forma-pagamento.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormaPagamento $formaPagamento
     * @return \Illuminate\Http\Response
     */
    public function edit(FormaPagamento $formaPagamento)
    {
        
        $tipoFormaPagamentos = TipoFormaPagamento::all();
        return view("forma-pagamento.create", ["formaPagamento" => $formaPagamento, "tipoFormaPagamentos" => $tipoFormaPagamentos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreFormaPagamentoRequest $request
     * @param  \App\Models\FormaPagamento $formaPagamento
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFormaPagamentoRequest $request, FormaPagamento $formaPagamento)
    {
        $parametros = $request->all();
        if($request->hasFile("arquivo") && $request->file("arquivo")->isValid()) {

            // Remove a foto antiga (caso exista)
            if(!empty($formaPagamento->foto)) {
                Storage::disk('public')->delete($formaPagamento->foto);
            }

            // Upload da nova foto
            $caminho = $this->obterValorConfiguracao("CAMINHO_IMAGENS_FORMAS_PAGAMENTO");
            $foto = Storage::disk('public')->putFile($caminho, $request->file('arquivo'));
            $parametros["foto"] = $foto;
        }

        $formaPagamento->update($parametros);
        toastr()->success('Forma de Pagamento alterado com sucesso');
        return redirect()->route("forma-pagamento.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormaPagamento $formaPagamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormaPagamento $formaPagamento)
    {
        if(!empty($formaPagamento->foto)) {
            Storage::disk('public')->delete($formaPagamento->foto);
        }
        $formaPagamento->delete();
        toastr()->success('Forma de Pagamento excluído com sucesso');
        return redirect()->route("forma-pagamento.index");
    }
}
