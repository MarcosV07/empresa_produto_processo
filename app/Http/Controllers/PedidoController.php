<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Estabelecimento;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\StatusPedido;
use App\Models\CategoriaProduto;
use App\Models\Usuario;

use App\Http\Requests\StorePedidoRequest;

class PedidoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $estabelecimentos = Estabelecimento::all();
        $produtos = Produto::all();
        $clientes = Cliente::all();
        $statusPedidos = StatusPedido::all();
        $pedidos = Pedido::with(["estabelecimento", "produto", "cliente", "statusPedido"]);

        $saldoCliente = 0;


        if(Auth::user()->perfil_id == 3){
            $cliente = Usuario::with(["cliente"])->where(['id' => Auth::user()->id])->get();
            if(!empty($cliente)){
                $saldoCliente = $cliente[0]->cliente->valor_saldo;
            }                        
        }
        
            
        // Filtros
        $parametros = $request->all();
        
        // Estabelecimento
        $estabelecimentoId = trim($parametros["estabelecimento_id"] ?? "");
        if(!empty($estabelecimentoId) || !empty(Auth::user()->estabelecimento_id) ) {
            $pedidos = $pedidos->where("estabelecimento_id", $parametros["estabelecimento_id"] ?? Auth::user()->estabelecimento_id);
            if(!empty(Auth::user()->estabelecimento_id)){
                $estabelecimentos = $estabelecimentos->where("id",Auth::user()->estabelecimento_id);
            }
        }

        // Produto
        $produtoId = trim($parametros["produto_id"] ?? "");
        if(!empty($produtoId)) {
            $pedidos = $pedidos->where("produto_id", $produtoId);
        }
         
        // Cliente
        $clienteId = trim($parametros["cliente_id"] ?? "");
        if(!empty($clienteId) || !empty(Auth::user()->cliente_id)) {
            $pedidos = $pedidos->where("cliente_id", $parametros["cliente_id"] ?? Auth::user()->cliente_id);
            if(!empty(Auth::user()->cliente_id)){
                $clientes = $clientes->where("id",Auth::user()->cliente_id);
            }
        }


        // Status do Pedido
        $statusPedidoId = trim($parametros["status_pedido_id"] ?? "");
        if(!empty($statusPedidoId)) {
            $pedidos = $pedidos->where("status_pedido_id", $statusPedidoId);
        }
       // dd(Auth::user()->cliente_id);

        $pedidos = $pedidos->orderBy("created_at", "desc")->paginate(50);   
        
        return view("pedido.index", [
            "pedidos" => $pedidos, 
            "estabelecimentos" => $estabelecimentos,
            "clientes"  => $clientes,
            "produtos" => $produtos,
            "statusPedidos" => $statusPedidos,
            "parametros" => $parametros,
            "saldoCliente" => $saldoCliente
        ]);  

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $estabelecimento = Estabelecimento::all();
        $categoriaProduto = CategoriaProduto::all();
        $lstprodutos = Produto::all();
        $produtos = Produto::with(["estabelecimento", "categoriaProduto"]);

        $saldoCliente = 0;

        if(Auth::user()->perfil_id == 3){
            $cliente = Usuario::with(["cliente"])->where(['id' => Auth::user()->id])->get();
            if(!empty($cliente)){
                $saldoCliente = $cliente[0]->cliente->valor_saldo;
            }            
        }
            
        // Filtros
        $parametros = $request->all();
        
        $estabelecimentoId = trim($parametros["estabelecimento_id"] ?? "");
        if(!empty($estabelecimentoId) || !empty(Auth::user()->estabelecimento_id)) {
            $produtos = $produtos->where("estabelecimento_id", "=", $parametros["estabelecimento_id"] ?? Auth::user()->estabelecimento_id);
        }

        $categoriaProdutoId = trim($parametros["categoria_id"] ?? "");
        if(!empty($categoriaProdutoId)) {
            $produtos = $produtos->where("categoria_produto_id", $parametros["categoria_id"]);
        }
         
        $listaProdutos = trim($parametros["produto_id"] ?? "");
        if(!empty($listaProdutos)) {
            $produtos = $produtos->where("id", $parametros["produto_id"]);
        }

        $produtos = $produtos->orderBy("nome", "asc")->paginate(50);

        return view("pedido.create", [
            "produtos" => $produtos, 
            "estabelecimentos" => $estabelecimento,
            "categoria_produtos"  => $categoriaProduto,
            "lstprodutos" => $lstprodutos,
            "saldoCliente" => $saldoCliente,
            "parametros" => $parametros
        ]); 
        
       
    }

     

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePedidoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePedidoRequest $request)
    {
        $cliente = Cliente::find(Auth::user()->cliente_id);       
        //Atualiza o saldo do Cliente
        if(!empty($cliente) && (Auth::user()->perfil_id == 3)) {
            $cliente->valor_saldo = ($cliente->valor_saldo - $request->valor_pedido);
            $cliente->save();
        }       
        
        Pedido::create($request->all());
        toastr()->success('Pedido cadastrado com sucesso');
        return redirect()->route("pedido.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        return view("pedido.create", ["pedido" => $pedido]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StorePedidoRequest $request
     * @param  \App\Models\Pedido $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(StorePedidoRequest $request, Pedido $pedido)
    {        
        $pedido->update($request->all());
        toastr()->success('Pedido alterado com sucesso');
        return redirect()->route("pedido.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        toastr()->success('Pedido excluído com sucesso');
        return redirect()->route("pedido.index");
    }
}
