<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Produto;
use App\Models\Estabelecimento;
use App\Models\CategoriaProduto;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;

class ProdutoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $estabelecimento = Estabelecimento::all();
        $categoriaProduto = CategoriaProduto::all();
        $lstprodutos = Produto::all();
        $produtos = Produto::with(["estabelecimento", "categoriaProduto"]);

       // dd($listaProdutos);
            
        // Filtros
        $parametros = $request->all();
        
        if(!empty(Auth::user()->estabelecimento_id)) {
            $produtos = $produtos->where("estabelecimento_id", Auth::user()->estabelecimento_id);
        }

        $estabelecimentoId = trim($parametros["estabelecimento_id"] ?? "");
        if(!empty($estabelecimentoId)) {
            $produtos = $produtos->where("estabelecimento_id", "=", $parametros["estabelecimento_id"]);
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

        return view("produto.index", [
            "produtos" => $produtos, 
            "estabelecimentos" => $estabelecimento,
            "categoria_produtos"  => $categoriaProduto,
            "lstprodutos" => $lstprodutos,
            "parametros" => $parametros
        ]);         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estabelecimentos = Estabelecimento::all();           
        
        if(!empty(Auth::user()->estabelecimento_id)) {
            $estabelecimentos = $estabelecimentos->where("id", Auth::user()->estabelecimento_id);
        }
        $categoriaProduto = CategoriaProduto::all();  
        return view("produto.create", ["estabelecimentos" => $estabelecimentos, "categoria_produtos" => $categoriaProduto]);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProdutoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProdutoRequest $request)
    {

        if(!empty($request["valor"])) {
            $request["valor"] = moneyToFloat($request["valor"]);
        }
        Produto::create($request->all());
        toastr()->success('Produto cadastrado com sucesso');
        return redirect()->route("produto.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        $estabelecimentos = Estabelecimento::all();   
        
        
        if(!empty(Auth::user()->estabelecimento_id)) {
            $estabelecimentos = $estabelecimentos->where("id", Auth::user()->estabelecimento_id);
        }
        $categoriaProduto = CategoriaProduto::all();  

        return view("produto.create", ["produto" => $produto, "estabelecimentos" => $estabelecimentos, "categoria_produtos" => $categoriaProduto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreProdutoRequest  $request
     * @param  \App\Models\Produto $produto
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProdutoRequest $request, Produto $produto)
    {
        if(!empty($request["valor"])) {
            $request["valor"] = moneyToFloat($request["valor"]);
        }
        $produto->update($request->all());
        toastr()->success('Produto alterado com sucesso');
        return redirect()->route("produto.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        toastr()->success('Produto excluído com sucesso');
        return redirect()->route("produto.index");
    }
}
