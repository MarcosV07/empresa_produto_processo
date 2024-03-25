<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreCategoriaProdutoRequest;
use App\Http\Requests\UpdateCategoriaProdutoRequest;
use App\Models\CategoriaProduto;

class CategoriaProdutoController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $categoriaProduto = CategoriaProduto::orderBy('nome', 'asc')->paginate(20);
        return view("categoria-produto.index", ["categoria_produtos" => $categoriaProduto]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("categoria-produto.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoriaProdutoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoriaProdutoRequest $request)
    {
        CategoriaProduto::create($request->all());
        toastr()->success('Categoria cadastrado com sucesso');
        return redirect()->route("categoria-produto.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoriaProduto $categoriaProduto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {           
        $categoriaProduto  = CategoriaProduto::find($id);
        
        return view("categoria-produto.create", ["categoria" => $categoriaProduto]);
     //   return view('categoria/create', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoriaProdutoRequest  $request
     * @param  \App\Models\CategoriaProduto $categoriaProduto
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoriaProdutoRequest $request, $id)
    {   
        $categoriaProduto  = CategoriaProduto::find($id);            
        $categoriaProduto->update($request->all());
        toastr()->success('Categoria alterado com sucesso');
        return redirect()->route("categoria-produto.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoriaProduto $categoriaProduto
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriaProduto $categoriaProduto)
    {
        $categoriaProduto->delete();
        toastr()->success('Categoria excluída com sucesso');
        return redirect()->route("categoria-produto.index");
    }
}
