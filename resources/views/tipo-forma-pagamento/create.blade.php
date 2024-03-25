@extends('adminlte::page')

@section('title', 'Tipo de Forma de Pagamento')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Tipo de Forma de Pagamento</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tipo-forma-pagamento.index') }}">Tipos de Forma de Pagamento</a></li>
                <li class="breadcrumb-item active">@if(isset($tipoFormaPagamento)) Edição @else Cadastro @endif</li>
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
                      {{ isset($tipoFormaPagamento) ? "Edição" : "Cadastro" }}
                    </h3>
                </div>
            </div>
              <div class="card-body">
                @if(isset($tipoFormaPagamento))
                  <form role="form" method="POST" action="{{ route('tipo-forma-pagamento.update', ['tipo_forma_pagamento' => $tipoFormaPagamento]) }}">
                    @method('PUT')
                @else
                  <form role="form" method="POST" action="{{ route('tipo-forma-pagamento.store') }}">
                @endif
                    @csrf
                    <div class="card-body">

                      <div class="form-group">
                        <label for="nome">Nome</label>
                        <x-adminlte-input name="nome" placeholder="Nome do Tipo de Forma de Pagamento" value="{{ $tipoFormaPagamento->nome ?? old('nome') }}" />
                      </div>
                      
                    </div>
                    <div class="card-footer">
                      <button type="button" onclick="window.location='{{ url()->previous() }}'" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</button>
                      <button type="submit" class="btn btn-primary">
                        @if(isset($tipoFormaPagamento))
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