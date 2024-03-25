<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBairroEstabelecimentoRequest;
use App\Http\Requests\UpdateBairroEstabelecimentoRequest;
use App\Models\BairroEstabelecimento;

class BairroEstabelecimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBairroEstabelecimentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBairroEstabelecimentoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BairroEstabelecimento  $bairroEstabelecimento
     * @return \Illuminate\Http\Response
     */
    public function show(BairroEstabelecimento $bairroEstabelecimento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BairroEstabelecimento  $bairroEstabelecimento
     * @return \Illuminate\Http\Response
     */
    public function edit(BairroEstabelecimento $bairroEstabelecimento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBairroEstabelecimentoRequest  $request
     * @param  \App\Models\BairroEstabelecimento  $bairroEstabelecimento
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBairroEstabelecimentoRequest $request, BairroEstabelecimento $bairroEstabelecimento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BairroEstabelecimento  $bairroEstabelecimento
     * @return \Illuminate\Http\Response
     */
    public function destroy(BairroEstabelecimento $bairroEstabelecimento)
    {
        //
    }
}
