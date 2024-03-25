@extends('adminlte::page')

@section('title', 'Dias')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Dias</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Dias</li>
            </ol>
        </div>
  </div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Listagem</h3> 
                <button class="btn btn-primary btn-xs float-right" onclick="window.location = '{{ route('dia.create') }}'">
                    <i class="fa fa-plus"></i> Novo
                </button>
            </div>
              <div class="card-body">
                    
                    @if(count($dias) > 0)
                        <div class="d-flex justify-content-center">{{ $dias->links() }}</div>
                        <div class="row">
                            <div class="col-md-6">Qtde. registros: {{ $dias->total() }}</div>
                            <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $dias->count() }}</div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome do Dia</th>
                                        <th>Dt. Inclusão</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dias as $dia)
                                    <tr>
                                        <td>{{ $dia->nome }}</td>
                                        <td>{{ Carbon\Carbon::parse($dia->created_at)->format('d/m/Y H:i:s') }}</td>
                                        <td class="text-center d-flex">
                                            <a class="text-white mr-1" href="{{ route('dia.edit', $dia->id) }}"><button class="btn btn-primary"><i class="fa fa-edit"></i> </button></a>
                                            <a href="#" onclick="$('#form_exclusao').attr('action', '{{ route('dia.destroy', $dia->id) }}')" data-toggle="modal" data-target="#modalConfirmDestroy"><button class="btn btn-danger"><i class="fa fa-times"></i> </button></a>
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
                            <div class="col-md-6">Qtde. registros: {{ $dias->total() }}</div>
                            <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $dias->count() }}</div>
                        </div>
                        <div class="d-flex justify-content-center">{{ $dias->links() }}</div>
                    @else
                        <div class="alert alert-info"><i class="fas fa-exclamation"></i> Nenhum dado localizado para os parâmetros indicados.</div>
                    @endif
              </div>
          </div>
    </div>
</div>
@stop