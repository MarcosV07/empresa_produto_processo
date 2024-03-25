<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $categoria = Categoria::orderBy('nome', 'asc')->paginate(20);
        return view("categoria.index", ["categorias" => $categoria]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("categoria.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoriaRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoriaRequest $request)
    {
        Categoria::create($request->all());
        toastr()->success('Categoria cadastrado com sucesso');
        return redirect()->route("categoria.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {           
        $categoria  = Categoria::find($id);
        
        return view("categoria.create", ["categoria" => $categoria]);
     //   return view('categoria/create', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoriaRequest  $request
     * @param  \App\Models\Categoria $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoriaRequest $request, $id)
    {   
        $categoria  = Categoria::find($id);            
        $categoria->update($request->all());
        toastr()->success('Categoria alterado com sucesso');
        return redirect()->route("categoria.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria  = Categoria::find($id);   
        $categoria->delete();
        toastr()->success('Categoria excluída com sucesso');
        return redirect()->route("categoria.index");
    }
}
