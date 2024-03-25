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
                <li class="breadcrumb-item active">Valor x Distância</li>
            </ol>
        </div>
  </div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Tabela de Valor x Distância</h3> 
                <button class="btn btn-primary btn-xs float-right" onclick="window.location = '{{ route('valor-distancia.create') }}'">
                    <i class="fa fa-plus"></i> Novo
                </button>
            </div>
              <div class="card-body">
                    
                    @if(count($valorDistancias) > 0)
                        <div class="d-flex justify-content-center">{{ $valorDistancias->links() }}</div>
                        <div class="row">
                            <div class="col-md-6">Qtde. registros: {{ $valorDistancias->total() }}</div>
                            <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $valorDistancias->count() }}</div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Km Inicio</th>
                                        <th>Km Final</th>
                                        <th class="text-right">Valor (R$)</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($valorDistancias as $valorDistancia)
                                    <tr>
                                        <td>{{ $valorDistancia->km_inicial }}</td>
                                        <td>{{ $valorDistancia->km_final }}</td>
                                        <td class="text-right">R$ {{ floatToMoney($valorDistancia->valor) }}</td>
                                        <td class="text-center d-flex">
                                            <a class="text-white mr-1" href="{{ route('valor-distancia.edit', ['valorDistancia' => $valorDistancia->id]) }}"><button class="btn btn-primary"><i class="fa fa-edit"></i> </button></a>
                                            <a href="#" onclick="$('#form_exclusao').attr('action', '{{ route('valor-distancia.destroy', $valorDistancia->id) }}')" data-toggle="modal" data-target="#modalConfirmDestroy"><button class="btn btn-danger"><i class="fa fa-times"></i> </button></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <x-adminlte-modal id="modalConfirmDestroy" title="Confirmação" size="sm" theme="default"
                            icon="fas fa-exclamation-triangle" v-centered static-backdrop scrollable>
                            Confirma a exclusão do registro ?
                            <x-slot name="footerSlot">
                                <form id="form_exclusao" action="#" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-success" type="submit">Confirmar</button>
                                </form>
                                <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal"/>
                            </x-slot>
                        </x-adminlte-modal>
                    
                        <div class="row">
                            <div class="col-md-6">Qtde. registros: {{ $valorDistancias->total() }}</div>
                            <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $valorDistancias->count() }}</div>
                        </div>
                        <div class="d-flex justify-content-center">{{ $valorDistancias->links() }}</div>
                    @else
                        <div class="alert alert-info"><i class="fas fa-exclamation"></i> Nenhum dado localizado para os parâmetros indicados.</div>
                    @endif
              </div>
          </div>
    </div>
</div>
@stop