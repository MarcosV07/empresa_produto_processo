@extends('adminlte::page')

@section('title', 'Tipo de Forma de Pagamento.')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Tipo de Forma de Pagamento.</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Tipo de Forma de Pagamento.</li>
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
                <button class="btn btn-primary btn-xs float-right" onclick="window.location = '{{ route('tipo-forma-pagamento.create') }}'">
                    <i class="fa fa-plus"></i> Novo
                </button>
            </div>
              <div class="card-body">
                    
                    <div class="d-flex justify-content-center">{{ $tipoFormaPagamentos->links() }}</div>
                    <div class="row">
                        <div class="col-md-6">Qtde. registros: {{ $tipoFormaPagamentos->total() }}</div>
                        <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $tipoFormaPagamentos->count() }}</div>
                    </div>
                    
                    @if(count($tipoFormaPagamentos) > 0)

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Dt. Inclusão</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($tipoFormaPagamentos as $tipoFormaPagamento)
                                    <tr>
                                        <td>{{ $tipoFormaPagamento->nome }}</td>
                                        <td>{{ Carbon\Carbon::parse($tipoFormaPagamento->created_at)->format('d/m/Y H:i:s') }}</td>
                                        <td class="text-center d-flex">
                                            <a class="text-white mr-1" href="{{ route('tipo-forma-pagamento.edit', $tipoFormaPagamento->id) }}"><button class="btn btn-primary"><i class="fa fa-edit"></i> </button></a>
                                            <a href="#" onclick="$('#form_exclusao').attr('action', '{{ route('tipo-forma-pagamento.destroy', $tipoFormaPagamento->id) }}')" data-toggle="modal" data-target="#modalConfirmDestroy"><button class="btn btn-danger"><i class="fa fa-times"></i> </button></a>
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
                            <div class="col-md-6">Qtde. registros: {{ $tipoFormaPagamentos->total() }}</div>
                            <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $tipoFormaPagamentos->count() }}</div>
                        </div>
                        <div class="d-flex justify-content-center">{{ $tipoFormaPagamentos->links() }}</div>
                    @else
                        <div class="alert alert-info"><i class="fas fa-exclamation"></i> Nenhum dado localizado para os parâmetros indicados.</div>
                    @endif
              </div>
          </div>
    </div>
</div>
@stop