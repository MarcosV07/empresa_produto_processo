@extends('adminlte::page')

@section('title', 'Situações de Estabelecimento')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Situações de Estabelecimento</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('situacao-estabelecimento.index') }}">Situações de Estabelecimento</a></li>
                <li class="breadcrumb-item active">@if(isset($situacaoEstabelecimento)) Edição @else Cadastro @endif</li>
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
                      {{ isset($situacaoEstabelecimento) ? "Edição" : "Cadastro" }}
                    </h3>
                </div>
            </div>
              <div class="card-body">
                @if(isset($situacaoEstabelecimento))
                  <form role="form" method="POST" action="{{ route('situacao-estabelecimento.update', ['situacao_estabelecimento' => $situacaoEstabelecimento]) }}">
                    @method('PUT')
                @else
                  <form role="form" method="POST" action="{{ route('situacao-estabelecimento.store') }}">
                @endif
                    @csrf
                    <div class="card-body">

                      <div class="form-group">
                        <label for="nome">Nome</label>
                        <x-adminlte-input name="nome" placeholder="Nome da Situação" value="{{ $situacaoEstabelecimento->nome ?? old('nome') }}" />
                      </div>
                      
                    </div>
                    <div class="card-footer">
                      <button type="button" onclick="window.location='{{ url()->previous() }}'" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</button>
                      <button type="submit" class="btn btn-primary">
                        @if(isset($situacaoEstabelecimento))
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