@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Clientes</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('perfil.index') }}">Clientes</a></li>
                <li class="breadcrumb-item active">@if(isset($cliente)) Edição @else Cadastro @endif</li>
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
                      {{ isset($perfil) ? "Edição" : "Cadastro" }}
                    </h3>
                </div>
            </div>
              <div class="card-body">
                @if(isset($cliente))
                  <form role="form" method="POST" action="{{ route('cliente.update', ['cliente' => $cliente]) }}">
                    @method('PUT')
                @else
                  <form role="form" method="POST" action="{{ route('cliente.store') }}">
                @endif
                    @csrf
                    <div class="card-body">
                      
                      <div class="row">
    
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="nome">Nome</label>
                            <x-adminlte-input name="nome" placeholder="Nome do Cliente" value="{{ $cliente->nome ?? old('nome') }}" />
                          </div>
                        </div>      
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="email">E-mail <span class="asterisco">*</span></label>
                            <x-adminlte-input type="email" name="email" id="email" placeholder="E-mail do Cliente" value="{{ $cliente->email ?? old('email') }}" />
                          </div>                  
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                          <label for="valor_fixo">Valor</label>
                          <x-adminlte-input type="text" class="money" id="valor_saldo" name="valor_saldo" placeholder="Valor de saldo" value="{{ $cliente->valor_saldo ?? old('valor_saldo') }}" />
                      </div>

                        </div> 
                      </div>
                    <div class="card-footer">
                      <button type="button" onclick="window.location='{{ url()->previous() }}'" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</button>
                      <button type="submit" class="btn btn-primary">
                        @if(isset($perfil))
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