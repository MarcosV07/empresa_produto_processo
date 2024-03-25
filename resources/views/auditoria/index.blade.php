@extends('adminlte::page')

@section('title', 'Auditorias')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Auditorias</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Auditorias</li>
            </ol>
        </div>
  </div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Filtro de Auditorias</h3> 
            </div>
              <div class="card-body">

                    <form action="{{ route('auditoria.index') }}" method="GET">
                        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Usuário</label>
                                    <x-adminlte-input name="name" placeholder="Nome do Usuário" value="{{ $parametros['name'] ?? '' }}" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tela">Tela</label>
                                    <x-adminlte-input name="tela" placeholder="Tela Acessada" value="{{ $parametros['tela'] ?? '' }}" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="periodo">Período</label>
                                    @php
                                    $config = [
                                        "timePicker" => true,
                                        "autoUpdateInput" => false,
                                        "locale" => [
                                            "format" => "DD/MM/YYYY HH:mm",
                                            "applyLabel" => 'Confirmar',
                                            "cancelLabel" => 'Cancelar',
                                            "daysOfWeek" => [
                                                "Dom",
                                                "Seg",
                                                "Ter",
                                                "Qua",
                                                "Qui",
                                                "Sex",
                                                "Sáb"
                                            ],
                                            "monthNames" => [
                                                "Jan",
                                                "Fev",
                                                "Mar",
                                                "Abr",
                                                "Mai",
                                                "Jun",
                                                "Jul",
                                                "Ago",
                                                "Set",
                                                "Out",
                                                "Nov",
                                                "Dez"
                                            ]
                                        ]
                                    ];
                                    @endphp
                                    <x-adminlte-date-range name="periodo" value="{{ $parametros['periodo'] ?? '' }}" :config="$config" placeholder="Período de Acesso" />
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Pesquisar</button>
                        <button class="btn btn-warning" type="button" onclick="limparFiltro()"><i class="fa fa-eraser"></i> Limpar</button>
                    </form>
                    
                    <br>

                    @if(count($auditorias) > 0)
                        <div class="d-flex justify-content-center">{{ $auditorias->appends($parametros)->links() }}</div>
                        <div class="row">
                            <div class="col-md-6">Qtde. registros: {{ $auditorias->total() }}</div>
                            <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $auditorias->count() }}</div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Usuário</th>
                                        <th>Dt. Registro</th>
                                        <th>Tela</th>
                                        <th>URL</th>
                                        <th>Dispositivo</th>
                                        <th>Dados</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($auditorias as $auditoria)
                                    <tr>
                                        <td>{{ $auditoria->usuario->name }}</td>
                                        <td>{{ Carbon\Carbon::parse($auditoria->created_at)->format('d/m/Y H:i:s') }}</td>
                                        <td>{{ $auditoria->tela->nome }}</td>
                                        <td>{{ $auditoria->url }}</td>
                                        <td>{{ $auditoria->dispositivo }}</td>
                                        <td>
                                            <a href="javascript:visualizarJSON('{{ $auditoria->dados }}')">
                                                <i class="fas fa-eye"></i> Visualizar
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-6">Qtde. registros: {{ $auditorias->total() }}</div>
                            <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $auditorias->count() }}</div>
                        </div>
                        <div class="d-flex justify-content-center">{{ $auditorias->appends($parametros)->links() }}</div>
                    @else
                        <div class="alert alert-info"><i class="fas fa-exclamation"></i> Nenhum dado localizado para os parâmetros indicados.</div>
                    @endif
              </div>
          </div>
    </div>
</div>

<x-adminlte-modal id="modalJson" title="Visualizador JSON" icon="fas fa-bolt" size='lg' disable-animations>
    <pre id="json-renderer"></pre>
    <x-slot name="footerSlot">
        <x-adminlte-button theme="default" label="Fechar" data-dismiss="modal"/>
    </x-slot>
</x-adminlte-modal>
@stop

@section('plugins.JsonViewer', true)

@section('js')
    <script type="text/javascript">
        
        function limparFiltro() {
            $("form").find("input").each(function(i, el) {
                $(el).val("");
            });
        }

        function visualizarJSON(json) {
            var data = JSON.parse(json);
            $('#json-renderer').jsonViewer(data);
            $("#modalJson").modal("show");
        }

        $('input[name="periodo"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY HH:mm') + ' - ' + picker.endDate.format('DD/MM/YYYY HH:mm'));
        });

        $('input[name="periodo"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        $('.json-renderer').jsonViewer();
    </script>
@stop