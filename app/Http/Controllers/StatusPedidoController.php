<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusPedido;
use App\Http\Requests\StoreStatusPedidoRequest;

class StatusPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statusPedido = StatusPedido::paginate(20);
        return view("status-pedido.index", ["status_pedidos" => $statusPedido]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("status-pedido.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStatusPedidoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStatusPedidoRequest $request)
    {
        StatusPedido::create($request->all());
        toastr()->success('Status do Pedido cadastrado com sucesso');
        return redirect()->route("status-pedido.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StatusPedido  $statusPedido
     * @return \Illuminate\Http\Response
     */
    public function edit(StatusPedido $statusPedido)
    {
        return view("status-pedido.create", ["statusPedido" => $statusPedido]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreStatusPedidoRequest $request
     * @param  \App\Models\StatusPedido $statusPedido
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStatusPedidoRequest $request, StatusPedido $statusPedido)
    {
        
        $statusPedido->update($request->all());
        toastr()->success('Status do Pedido alterada com sucesso');
        return redirect()->route("status-pedido.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StatusPedido $statusPedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusPedido $statusPedido)
    {
        $statusPedido->delete();
        toastr()->success('Status do Pedido excluído com sucesso');
        return redirect()->route("status-pedido.index");
    }
}
