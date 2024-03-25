@extends('adminlte::page')

@section('title', 'Valor x Distância')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Valor x Distância</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('valor-distancia.index') }}">Valor x Distância</a></li>
                <li class="breadcrumb-item active">@if(isset($valorDistancia)) Edição @else Cadastro @endif</li>
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
                      {{ isset($valorDistancia) ? "Edição" : "Cadastro" }}
                    </h3>
                </div>
            </div>
              <div class="card-body">
                @if(isset($valorDistancia))
                  <form role="form" method="POST" action="{{ route('valor-distancia.update', ['valorDistancia' => $valorDistancia]) }}">
                    @method('PUT')
                @else
                  <form role="form" method="POST" action="{{ route('valor-distancia.store') }}">
                @endif
                    @csrf
                    <div class="card-body">

                      <div class="form-group">
                        <label for="km_inicial">Km Inicial</label>
                        <x-adminlte-input id="km_inicial" name="km_inicial" placeholder="Km Inicial" value="{{ $valorDistancia->km_inicial ?? old('km_inicial') }}" type="number" />
                      </div>

                      <div class="form-group">
                        <label for="km_final">Km Final</label>
                        <x-adminlte-input id="km_final" name="km_final" placeholder="Km Final" value="{{ $valorDistancia->km_final ?? old('km_final') }}" type="number" />
                      </div>

                      <div class="form-group">
                        <label for="valor_fixo">Valor</label>
                        <x-adminlte-input type="text" class="money" id="valor" name="valor" placeholder="Valor da Faixa de Km" value="{{ $valorDistancia->valor ?? old('valor') }}" />
                      </div>
                      
                    </div>
                    <div class="card-footer">
                      <button type="button" onclick="window.location='{{ url()->previous() }}'" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</button>
                      <button type="submit" class="btn btn-primary">
                        @if(isset($valorDistancia))
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