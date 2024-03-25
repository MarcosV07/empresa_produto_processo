@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Usuários</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Usuários</li>
            </ol>
        </div>
  </div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Filtro de usuários</h3> 
                <button class="btn btn-primary btn-xs float-right" onclick="window.location = '{{ route('usuario.create') }}'">
                    <i class="fa fa-plus"></i> Novo
                </button>
            </div>
              <div class="card-body">

                    <form action="{{ route('usuario.index') }}" method="GET">
                        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <x-adminlte-input name="name" placeholder="Nome do Usuário" value="{{ $parametros['name'] ?? '' }}" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="perfil_id">Perfil</label>
                                      <select name="perfil_id" id="perfil_id" class="form-control">
                                        <option value="">- Selecione -</option>
                                        @foreach($perfis as $perfil)
                                          <option {{ ($perfil->id == ($parametros['perfil_id'] ?? null)) ? "selected" : "" }} value="{{ $perfil->id }}">
                                            {{ $perfil->nome }}
                                          </option>
                                        @endforeach
                                      </select>
                                  </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Pesquisar</button>
                        <button class="btn btn-warning" type="button" onclick="limparFiltro()"><i class="fa fa-eraser"></i> Limpar</button>
                    </form>
                    
                    <br>

                    @if(count($usuarios) > 0)
                        <div class="d-flex justify-content-center">{{ $usuarios->appends($parametros)->links() }}</div>
                        <div class="row">
                            <div class="col-md-6">Qtde. registros: {{ $usuarios->total() }}</div>
                            <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $usuarios->count() }}</div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Perfil</th>
                                        <th>E-mail</th>
                                        <th>Ativo</th>
                                        <th>Dt. Inclusão</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $usuario->name }}</td>
                                        <td>{{ $usuario->perfil->nome }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>{{ $usuario->ativo ? "Sim" : "Não" }}</td>
                                        <td>{{ Carbon\Carbon::parse($usuario->created_at)->format('d/m/Y H:i:s') }}</td>
                                        <td class="text-center">
                                            <a href="{{ $usuario->ativo ? route('usuario.desativar', ['usuario' => $usuario]) : route('usuario.ativar', ['usuario' => $usuario]) }}" class="{{ $usuario->ativo ? "text-danger" : "text-success" }}"><i class="{{ $usuario->ativo ? "fas fa-toggle-on" : "fas fa-toggle-off" }}"></i> {{ $usuario->ativo ? "Desativar" : "Ativar" }}</a> <br>
                                            <a href="{{ route('usuario.edit', ['usuario' => $usuario]) }}"><i class="fa fa-edit"></i> Editar</a> <br>
                                            <a href="#" onclick="$('#form_exclusao').attr('action', '{{ route('usuario.destroy', $usuario->id) }}')" data-toggle="modal" data-target="#modalConfirmDestroy"><i class="fa fa-times"></i> Excluir</a>
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
                            <div class="col-md-6">Qtde. registros: {{ $usuarios->total() }}</div>
                            <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $usuarios->count() }}</div>
                        </div>
                        <div class="d-flex justify-content-center">{{ $usuarios->appends($parametros)->links() }}</div>
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