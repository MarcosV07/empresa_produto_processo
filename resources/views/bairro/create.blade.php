@extends('adminlte::page')

@section('title', 'Bairros')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Bairros</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('bairro.index') }}">Bairros</a></li>
                <li class="breadcrumb-item active">@if(isset($bairro)) Edição @else Cadastro @endif</li>
            </ol>
        </div>
  </div>
@stop

@section('plugins.Leaflet', true)

@section('js')
  <script>
    var zoom = 6;
    var flAdicionarPin = 1;

    var latitude = "{{ $bairro->latitude ?? old("latitude") }}";
    if(latitude) {
      zoom = 17;
    } else {
      latitude = -13.389838;
    }

    var longitude = "{{ $bairro->longitude ?? old("longitude") }}";
    if(longitude) {
      zoom = 17;
    } else {
      longitude = -36.816017;
    }
  </script>
  <script src="{{ asset("js/bairro/bairro.js") }}"></script>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <div class="row">
                    <h3 class="card-title">
                      {{ isset($bairro) ? "Edição" : "Cadastro" }}
                    </h3>
                </div>
            </div>
              <div class="card-body">
                @if(isset($bairro))
                  <form role="form" method="POST" action="{{ route('bairro.update', ['bairro' => $bairro]) }}">
                    @method('PUT')
                @else
                  <form role="form" method="POST" action="{{ route('bairro.store') }}">
                @endif
                    @csrf
                    <div class="card-body">

                      <div class="form-group">
                        <label for="nome">Estado</label>
                        <x-adminlte-input id="estado" name="estado" placeholder="Estado do Bairro" value="{{ $bairro->estado ?? old('estado') }}" />
                      </div>

                      <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <x-adminlte-input id="cidade" name="cidade" placeholder="Cidade do Bairro" value="{{ $bairro->cidade ?? old('cidade') }}" />
                      </div>

                      <div class="form-group">
                        <label for="bairro">Bairro</label>
                        <x-adminlte-input id="bairro" name="bairro" placeholder="Bairro" value="{{ $bairro->bairro ?? old('bairro') }}" />
                      </div>
                      
                      <div class="row">
                        <div class="col-md-6">
                          <div id="map" style="width: 100%; height: 300px;"></div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <x-adminlte-input type="text" id="latitude" name="latitude" placeholder="Latitude do Bairro" value="{{ $bairro->latitude ?? old('latitude') }}" />
                          </div>
                          
                          <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <x-adminlte-input type="text" id="longitude" name="longitude" placeholder="Longitude do Bairro" value="{{ $bairro->longitude ?? old('longitude') }}" />
                          </div>
                        </div>
                      </div>
                      

                    </div>
                    <div class="card-footer">
                      <button type="button" onclick="window.location='{{ url()->previous() }}'" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</button>
                      <button type="submit" class="btn btn-primary">
                        @if(isset($bairro))
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