@extends('adminlte::page')

@section('title', 'Forma de Pagamento')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Forma de Pagamento</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('forma-pagamento.index') }}">Formas de Pagamento</a></li>
                <li class="breadcrumb-item active">@if(isset($formaPagamento)) Edição @else Cadastro @endif</li>
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
                      {{ isset($formaPagamento) ? "Edição" : "Cadastro" }}
                    </h3>
                </div>
            </div>
              <div class="card-body">
                @if(isset($formaPagamento))
                  <form role="form" method="POST" action="{{ route('forma-pagamento.update', ['forma_pagamento' => $formaPagamento]) }}" enctype="multipart/form-data">
                    @method('PUT')
                @else
                  <form role="form" method="POST" action="{{ route('forma-pagamento.store') }}" enctype="multipart/form-data">
                @endif
                    @csrf
                    <div class="card-body">

                      <div class="form-group">
                        <label for="nome">Nome</label>
                        <x-adminlte-input name="nome" placeholder="Nome da Forma de Pagamento" value="{{ $formaPagamento->nome ?? old('nome') }}" />
                      </div>

                      <div class="form-group">
                        <label for="tipo_forma_pagamento_id">Tipo de Forma de Pagamento</label>
                          <x-adminlte-select name="tipo_forma_pagamento_id" id="tipo_forma_pagamento_id" class="form-control">
                            <option value="">- Selecione -</option>
                            @foreach($tipoFormaPagamentos as $tipoFormaPagamento)
                              <option {{ $tipoFormaPagamento->id == ($formaPagamento->tipo_forma_pagamento_id ?? old('tipo_forma_pagamento_id')) ? "selected" : "" }} value="{{ $tipoFormaPagamento->id }}">
                                {{ $tipoFormaPagamento->nome }}
                              </option>
                            @endforeach
                          </x-adminlte-select>
                      </div>

                      <div class="form-group">
                        <label for="nome">Imagem</label>
                      <input type="file" name="arquivo" class="form-control"/>
                      </div>
                      
                    </div>
                    <div class="card-footer">
                      <button type="button" onclick="window.location='{{ url()->previous() }}'" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</button>
                      <button type="submit" class="btn btn-primary">
                        @if(isset($formaPagamento))
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