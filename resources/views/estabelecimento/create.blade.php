@extends('adminlte::page')

@section('title', 'Estabelecimentos')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-8">
            <h1>

              @if(isset($estabelecimento->logotipo))
                <img src="{{ asset("storage/$estabelecimento->logotipo") }}" class="logotipo-estabelecimento">
              @else
                <i class="fa fa-building"></i>
              @endif

              @if(!isset($estabelecimento)) Novo Estabelecimento @else {{ $estabelecimento->nome }} @endif
            </h1>
        </div>
        <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('estabelecimento.index') }}">Estabelecimentos</a></li>
                <li class="breadcrumb-item active">@if(isset($estabelecimento)) Edição @else Cadastro @endif</li>
            </ol>
        </div>
  </div>
@stop

@section('plugins.Leaflet', true)

@section('css')
    <style>
      .listaDia {
        padding: 5px !important;
        list-style-type: disclosure-closed;
      }
      .logotipo-estabelecimento {
        max-width: 50px;
      }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('js')
    <script>
      var zoom = 6;
      var flAdicionarPin = 0;

      var latitude = "{{ $estabelecimento->latitude ?? old("latitude") }}";
      if(latitude) {
        zoom = 17;
        flAdicionarPin = 1;
      } else {
        latitude = -13.389838;
      }

      var longitude = "{{ $estabelecimento->longitude ?? old("longitude") }}";
      if(longitude) {
        zoom = 17;
        flAdicionarPin = 1;
      } else {
        longitude = -36.816017;
      }

      
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v7.1.0/ol.css">
    <script src="{{ asset("js/estabelecimento/estabelecimento.js") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/ol@v7.1.0/dist/ol.js"></script>
    
    <script>
      @php
        $diaEstabelecimentos = old("dia_estabelecimentos") ?? $diaEstabelecimentos;
      @endphp
      
      @if(isset($diaEstabelecimentos) && !empty($diaEstabelecimentos))
        @foreach($diaEstabelecimentos as $diaEstabelecimento)
            
            @php

              if(isset($diaEstabelecimento->horario_inicio) && isset($diaEstabelecimento->horario_fim)) {
                $diaId = $diaEstabelecimento->dia_id;
                $faixaHorario = substr($diaEstabelecimento->horario_inicio, 0, 5) . "-" . substr($diaEstabelecimento->horario_fim, 0, 5);
              } else {
                $diaId = key($diaEstabelecimento);
                $faixaHorario = current($diaEstabelecimento);
              }
              
            @endphp

            exibirHorario({{ $diaId }}, "{{ $faixaHorario }}") 
            
        @endforeach
      @endif
    </script>

@stop

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card card-default">
          @if(isset($estabelecimento))
            <form role="form" method="POST" action="{{ route('estabelecimento.update', ['estabelecimento' => $estabelecimento]) }}" enctype="multipart/form-data">
              @method('PUT')
          @else
            <form role="form" method="POST" action="{{ route('estabelecimento.store') }}" enctype="multipart/form-data">
          @endif
              @csrf

          <input type="hidden" id="idEstabelecimento" value="{{ $estabelecimento->id ?? ''}}" name="id" >
          <div class="card-header">
            <div class="card-header p-0 pt-1 border-bottom-0">
              <ul class="nav nav-tabs" id="estabelecimento-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="dados-tab" data-toggle="pill" href="#dados" role="tab" aria-controls="dados" aria-selected="true">Dados</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="localizacao-tab" data-toggle="pill" href="#localizacao" role="tab" aria-controls="localizacao" aria-selected="false" onclick="setTimeout(() => {initMap($('#latitude').val(), $('#longitude').val(), 15)}, 800)">Localização</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="horario-funcionamento-tab" data-toggle="pill" href="#horario-funcionamento" role="tab" aria-controls="horario-funcionamento" aria-selected="false">Horário de Funcionamento</a>
                </li>
                                    
              
              </ul>
            </div>
          </div>

          <div class="card-body">
            
            <div class="tab-content" id="estabelecimento-tabContent">
              
              <div class="tab-pane fade show active" id="dados" role="tabpanel" aria-labelledby="dados-tab">
                @component('estabelecimento._components.dados-tab', ["tipoPessoas" => $tipoPessoas, "categorias" => $categoria, "situacoesEstabelecimento" => $situacoesEstabelecimento, "estabelecimento" => $estabelecimento])
                @endcomponent
              </div>

              <div class="tab-pane fade" id="localizacao" role="tabpanel" aria-labelledby="localizacao-tab">
                <div id="app">
                  <localizacao-tab :estabelecimento="{{ $estabelecimento }}"></localizacao-tab>
                </div>
              </div>

              <div class="tab-pane fade" id="horario-funcionamento" role="tabpanel" aria-labelledby="horario-funcionamento-tab">
                @component('estabelecimento._components.horario-funcionamento-tab', ["dias" => $dias, "diaEstabelecimentos" => $diaEstabelecimentos])
                @endcomponent
              </div>

              <div class="tab-pane fade" id="forma-pagamento" role="tabpanel" aria-labelledby="forma-pagamento-tab">
                @component('estabelecimento._components.forma-pagamento-tab', ["tipoFormaPagamentos" => $tipoFormaPagamentos, "formaPagamentoEstabelecimentos" => $formaPagamentoEstabelecimentos, "eSuperAdmin" => $eSuperAdmin])
                @endcomponent
              </div>

              <div class="tab-pane fade" id="valor-entrega" role="tabpanel" aria-labelledby="valor-entrega-tab">
                @component('estabelecimento._components.valor-entrega-tab', ["bairros" => $bairros, "bairrosEstabelecimentos" => $bairrosEstabelecimentos])
                @endcomponent
              </div>

              <div class="tab-pane fade" id="configuracao" role="tabpanel" aria-labelledby="configuracao-tab">
                @component('estabelecimento._components.configuracao-tab', ["estabelecimento" => $estabelecimento])
                @endcomponent
              </div>

              <div class="tab-pane fade" id="acesso" role="tabpanel" aria-labelledby="acesso-tab">
                @component('estabelecimento._components.acesso-tab', ["usuariosEstabelecimento" => $usuariosEstabelecimento])
                @endcomponent
              </div>

            </div>
          </div>

          <div class="card-footer">
            {{-- Botão de voltar --}}
            <button type="button" onclick="window.location='{{ route('estabelecimento.index') }}'" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</button>
            
            {{-- Botão p/ persistir --}}
            <button type="submit" class="btn btn-primary">
              @if(isset($estabelecimento))
                <i class="fa fa-edit"></i> Alterar
              @else
                <i class="fa fa-save"></i> Salvar
              @endif
            </button>
          </div>
      </form>
      <form action="{{ route('bairro.obterBairrosPorCidade') }}" id="frmObterBairrosPorCidade"></form>
      <form action="{{ route('bairro.obterLatitudeLongitude') }}" id="frmObterLatitudeLongitude"></form>
      <form action="{{ route('usuario.ativarDesativarAcessoUsuarioEstabelecimento') }}" id="frmAtivarDesativarAcessoUsuarioEstabelecimento"></form>
      
    </div>
  </div>
</div>

<script src="{{ mix('js/app.js')}}"></script>
@stop