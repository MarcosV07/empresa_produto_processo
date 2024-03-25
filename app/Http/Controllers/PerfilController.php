<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePerfilRequest;
use App\Http\Requests\UpdatePerfilRequest;
use App\Models\Perfil;

class PerfilController extends Controller
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
        $perfis = Perfil::paginate(20);
        return view("perfil.index", ["perfis" => $perfis]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("perfil.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePerfilRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePerfilRequest $request)
    {
        Perfil::create($request->all());
        toastr()->success('Perfil cadastrado com sucesso');
        return redirect()->route("perfil.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        return view("perfil.create", ["perfil" => $perfil]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StorePerfilRequest  $request
     * @param  \App\Models\Perfil $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(StorePerfilRequest $request, Perfil $perfil)
    {
        $perfil->update($request->all());
        toastr()->success('Perfil alterado com sucesso');
        return redirect()->route("perfil.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perfil $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        $perfil->delete();
        toastr()->success('Perfil excluído com sucesso');
        return redirect()->route("perfil.index");
    }
}
