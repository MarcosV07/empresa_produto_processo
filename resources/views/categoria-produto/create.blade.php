@extends('adminlte::page')

@section('title', 'Categoria')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>categoria</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categoria-produto.index') }}">Categoria</a></li>
                <li class="breadcrumb-item active">@if(isset($categoria)) Edição @else Cadastro @endif</li>
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
                      {{ isset($categoria) ? "Edição" : "Cadastro" }}
                    </h3>
                </div>
            </div>
              <div class="card-body">
                @if(isset($categoria))
                  <form role="form" method="POST"  name="form2"   action="{{ route('categoria-produto.update', $categoria->id) }}">
                  
                    @method('PUT')
                @else
                  <form role="form" method="POST" action="{{ route('categoria-produto.store') }}">
                @endif
                    @csrf
                    <div class="card-body">

                      <div class="form-group">
                        <label for="nome">Nome</label>
                        <x-adminlte-input id="nome" name="nome" placeholder="Categoria do Produto" value="{{ $categoria->nome ?? old('nome') }}" />
                      </div>                    
                                                                  
                    </div>
                    <div class="card-footer">
                      <button type="button" onclick="window.location='{{ url()->previous() }}'" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</button>
                      <button type="submit" class="btn btn-primary">
                        @if(isset($plano))
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