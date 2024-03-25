<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModuloRequest;
use App\Http\Requests\UpdateModuloRequest;
use App\Models\Modulo;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulos = Modulo::paginate(20);
        return view("modulo.index", ["modulos" => $modulos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("modulo.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreModuloRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModuloRequest $request)
    {
        Modulo::create($request->all());
        toastr()->success('Modulo cadastrado com sucesso');
        return redirect()->route("modulo.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Modulo $modulo)
    {
        return view("modulo.create", ["modulo" => $modulo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreModuloRequest  $request
     * @param  \App\Models\Modulo $modulo
     * @return \Illuminate\Http\Response
     */
    public function update(StoreModuloRequest $request, Modulo $modulo)
    {
        $modulo->update($request->all());
        toastr()->success('Modulo alterado com sucesso');
        return redirect()->route("modulo.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modulo $modulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modulo $modulo)
    {
        $modulo->delete();
        toastr()->success('Modulo excluído com sucesso');
        return redirect()->route("modulo.index");
    }
}
