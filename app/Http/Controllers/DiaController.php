<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiaRequest;
use App\Http\Requests\UpdateDiaRequest;
use App\Models\Dia;

class DiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dias = Dia::paginate(20);
        return view("dia.index", ["dias" => $dias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dia.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDiaRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiaRequest $request)
    {
        Dia::create($request->all());
        toastr()->success('Dia cadastrado com sucesso');
        return redirect()->route("dia.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dia  $dia
     * @return \Illuminate\Http\Response
     */
    public function edit(Dia $dia)
    {
        return view("dia.create", ["dia" => $dia]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreDiaRequest  $request
     * @param  \App\Models\Dia $dia
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDiaRequest $request, Dia $dia)
    {
        $dia->update($request->all());
        toastr()->success('Dia alterado com sucesso');
        return redirect()->route("dia.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dia $dia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dia $dia)
    {
        $dia->delete();
        toastr()->success('Dia excluído com sucesso');
        return redirect()->route("dia.index");
    }
}
