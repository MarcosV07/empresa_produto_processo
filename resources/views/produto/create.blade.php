@extends('adminlte::page')

@section('title', 'Produto')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Produto</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('produto.index') }}">Produto</a></li>
                <li class="breadcrumb-item active">@if(isset($produto)) Edição @else Cadastro @endif</li>
            </ol>
        </div>
  </div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <div class="row">
                    <h3 class="card-title">
                      {{ isset($produto) ? "Edição" : "Cadastro" }}
                    </h3>
                </div>
            </div>
              <div class="card-body">
                @if(isset($produto))
                  <form role="form" method="POST" action="{{ route('produto.update', ['produto' => $produto]) }}">
                    @method('PUT')
                @else
                  <form role="form" method="POST" action="{{ route('produto.store') }}">
                @endif
                    @csrf
                    <div class="card-body">

                    <div class="form-group">
                        <label for="tipo_forma_pagamento_id"> Estabelecimento </label>
                          <x-adminlte-select name="estabelecimento_id" id="estabelecimento_id" class="form-control">
                            <option value="">- Selecione -</option>
                            @foreach($estabelecimentos as $estabelecimento)
                              <option {{ $estabelecimento->id == ($produto->id ?? old('estabelecimento_id')) ? "selected" : "" }} value="{{ $estabelecimento->id }}">
                                {{ $estabelecimento->nome }}
                              </option>
                            @endforeach
                          </x-adminlte-select>
                      </div>

                      <div class="form-group">
                        <label for="nome">Nome</label>
                        <x-adminlte-input name="nome" placeholder="Nome do Produto" value="{{ $produto->nome ?? old('nome') }}" />
                      </div>

                      <div class="form-group">
                        <label for="categoria_produto_id"> Categoria do Produto </label>
                          <x-adminlte-select name="categoria_produto_id" id="categoria_produto_id" class="form-control">
                            <option value="">- Selecione -</option>
                            @foreach($categoria_produtos as $categoria_produto)
                              <option {{ $categoria_produto->id == ($produto->categoria_produto_id ?? old('categoria_produto_id')) ? "selected" : "" }} value="{{ $categoria_produto->id }}">
                                {{ $categoria_produto->nome }}
                              </option>
                            @endforeach
                          </x-adminlte-select>
                      </div>
                      
                      <div class="form-group">
                        <label for="valor">Valor do Produto (R$)</label>
                        <x-adminlte-input type="text" class="money" id="valor" name="valor" placeholder="Valor do produto" value="{{ $produto->valor ?? old('valor') }}" />
                      </div>
    
                      
                    </div>
                    <div class="card-footer">
                      <button type="button" onclick="window.location='{{ url()->previous() }}'" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</button>
                      <button type="submit" class="btn btn-primary">
                        @if(isset($produto))
                        <i class="fa fa-edit"></i> Alterar
                        @else
                        <i class="fa fa-save"></i> Salvar
                        @endif
                      </button>
                    </div>
                  </form>
              </div>
          </div>
    </div>
</div>
@stop