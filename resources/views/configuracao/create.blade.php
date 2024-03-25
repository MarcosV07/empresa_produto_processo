@extends('adminlte::page')

@section('title', 'Configurações')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Configurações</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('configuracao.index') }}">Configurações</a></li>
                <li class="breadcrumb-item active">@if(isset($configuracao)) Edição @else Cadastro @endif</li>
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
                      {{ isset($configuracao) ? "Edição" : "Cadastro" }}
                    </h3>
                </div>
            </div>
              <div class="card-body">
                @if(isset($configuracao))
                  <form role="form" method="POST" action="{{ route('configuracao.update', ['configuracao' => $configuracao]) }}">
                    @method('PUT')
                @else
                  <form role="form" method="POST" action="{{ route('configuracao.store') }}">
                @endif
                    @csrf
                    <div class="card-body">

                      <div class="form-group">
                        <label for="chave">Chave</label>
                        <x-adminlte-input name="chave" placeholder="Chave da Configuração" value="{{ $configuracao->chave ?? old('chave') }}" />
                      </div>

                      <div class="form-group">
                        <label for="valor">Valor</label>
                        <x-adminlte-input name="valor" placeholder="Valor da Configuração" value="{{ $configuracao->valor ?? old('valor') }}" />
                      </div>

                      <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <x-adminlte-textarea name="descricao">
                          {{ $configuracao->descricao ?? old('descricao') }}
                        </x-adminlte-textarea>
                      </div>

                    </div>
                    <div class="card-footer">
                      <button type="button" onclick="window.location='{{ url()->previous() }}'" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</button>
                      <button type="submit" class="btn btn-primary">
                        @if(isset($configuracao))
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