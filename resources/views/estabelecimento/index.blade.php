@extends('adminlte::page')

@section('title', 'Estabelecimentos')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Estabelecimentos</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Estabelecimentos</li>
            </ol>
        </div>
  </div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Filtro de Estabelecimentos</h3> 
                <button class="btn btn-primary btn-xs float-right" onclick="window.location = '{{ route('estabelecimento.create') }}'">
                    <i class="fa fa-plus"></i> Novo
                </button>
            </div>
              <div class="card-body">

                    <form action="{{ route('estabelecimento.index') }}" method="GET">
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <x-adminlte-input name="nome" id="nome" placeholder="Nome do Estabelecimento" value="{{ $parametros['nome'] ?? '' }}" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="categoria_id">Categoria</label>
                                      <select name="categoria_id" id="categoria_id" class="form-control">
                                        <option value="">- Selecione -</option>
                                        @foreach($categorias as $categoria)
                                          <option {{ ($categoria->id == ($parametros['categoria_id'] ?? null)) ? "selected" : "" }} value="{{ $categoria->id }}">
                                            {{ $categoria->nome }}
                                          </option>
                                        @endforeach
                                      </select>
                                  </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="situacao_estabelecimento_id">Situação</label>
                                      <select name="situacao_estabelecimento_id" id="situacao_estabelecimento_id" class="form-control">
                                        <option value="">- Selecione -</option>
                                        @foreach($situacoes as $situacao)
                                          <option {{ ($situacao->id == ($parametros['situacao_estabelecimento_id'] ?? null)) ? "selected" : "" }} value="{{ $situacao->id }}">
                                            {{ $situacao->nome }}
                                          </option>
                                        @endforeach
                                      </select>
                                  </div>
                            </div>                            
                        </div>

                        {{--<div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="online" name="online" {{ (isset($parametros["online"]) ?? false) ? "checked" : ""}}>
                                    <label class="form-check-label" for="online">Estabelecimentos online</label>
                                  </div>
                            </div>
                        </div>--}}

                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Pesquisar</button>
                        <button class="btn btn-warning" type="button" onclick="limparFiltro()"><i class="fa fa-eraser"></i> Limpar</button>
                    </form>
                    
                    <br>

                    @if(count($estabelecimentos) > 0)
                        <div class="d-flex justify-content-center">{{ $estabelecimentos->appends($parametros)->links() }}</div>
                        <div class="row">
                            <div class="col-md-6">Qtde. registros: {{ $estabelecimentos->total() }}</div>
                            <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $estabelecimentos->count() }}</div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Nº Documento</th>
                                        <th>Telefone</th>
                                        <th>Endereço</th>
                                        <th>Categoria</th>
                                        <th>Situação</th>                                        
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($estabelecimentos as $estabelecimento)
                                    <tr>
                                        <td>{{ $estabelecimento->nome }}</td>
                                        <td>{{ $estabelecimento->numero_documento }}</td>
                                        <td>{{ $estabelecimento->telefone }}</td>
                                        <td>{{ $estabelecimento->logradouro . " - Nº " . $estabelecimento->numero }}</td>
                                        <td>{{ $estabelecimento->categoria->nome }}</td>
                                        <td>{{ $estabelecimento->situacaoEstabelecimento->nome }}</td>                                        
                                        <td class="text-center d-flex">
                                            <a class="text-white mr-1" href="{{ route('estabelecimento.edit', $estabelecimento->id) }}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a> <br>
                                            <a href="#" onclick="$('#form_exclusao').attr('action', '{{ route('estabelecimento.destroy', $estabelecimento->id) }}')" data-toggle="modal" data-target="#modalConfirmDestroy"><button class="btn btn-danger"><i class="fa fa-times"></i> </button></a>
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
                                    <button class="btn btn-success" type="submit" id="btnConfirmDestroy">Confirmar</button>
                                </form>
                                <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal"/>
                            </x-slot>
                        </x-adminlte-modal>
                    
                        <div class="row">
                            <div class="col-md-6">Qtde. registros: {{ $estabelecimentos->total() }}</div>
                            <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $estabelecimentos->count() }}</div>
                        </div>
                        <div class="d-flex justify-content-center">{{ $estabelecimentos->appends($parametros)->links() }}</div>
                    @else
                        <div class="alert alert-info"><i class="fas fa-exclamation"></i> Nenhum dado localizado para os parâmetros indicados.</div>
                    @endif
              </div>
          </div>
    </div>
</div>
@stop

@section('js')
    <script type="text/javascript">
        function limparFiltro() {
            $("form").find("input,select").each(function(i, el) {
                $(el).val("");
            });
        }
    </script>
@stop