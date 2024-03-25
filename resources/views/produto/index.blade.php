@extends('adminlte::page')

@section('title', 'Produto')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Produtos</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Produtos</li>
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
                <button class="btn btn-primary btn-xs float-right" onclick="window.location = '{{ route('produto.create') }}'">
                    <i class="fa fa-plus"></i> Novo
                </button>
            </div>
              <div class="card-body">

              <form action="{{ route('produto.index') }}" method="GET">
                        
                        <div class="row">
                        @if(empty(Auth::user()->estabelecimento_id))
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="estabelecimento_id">Estabelecimento: </label>
                                      <select name="estabelecimento_id" id="estabelecimento_id" class="form-control select">
                                        <option value="">- Selecione -</option>
                                        @foreach($estabelecimentos as $estabelecimento)
                                          <option {{ ($estabelecimento->id == ($parametros['estabelecimento_id'] ?? null)) ? "selected" : "" }} value="{{ $estabelecimento->id }}">
                                            {{ $estabelecimento->nome }}
                                          </option>
                                        @endforeach
                                      </select>
                                  </div>
                            </div>
                            @endif

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="categoria_id">Categoria do Produto: </label>
                                      <select name="categoria_id" id="categoria_id" class="form-control select">
                                        <option value="">- Selecione -</option>
                                        @foreach($categoria_produtos as $categoria)
                                          <option {{ ($categoria->id == ($parametros['categoria_id'] ?? null)) ? "selected" : "" }} value="{{ $categoria->id }}">
                                            {{ $categoria->nome }}
                                          </option>
                                        @endforeach
                                      </select>
                                  </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="produto_id">Produto:</label>
                                      <select name="produto_id" id="produto_id" class="form-control select">
                                        <option value="">- Selecione -</option>
                                        @foreach($lstprodutos as $lista_produto)
                                          <option {{ ($lista_produto->id == ($parametros['produto_id'] ?? null)) ? "selected" : "" }} value="{{ $lista_produto->id }}">
                                            {{ $lista_produto->nome }}
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
                    
                    <div class="d-flex justify-content-center">{{ $produtos->links() }}</div>
                    <div class="row">
                        <div class="col-md-6">Qtde. registros: {{ $produtos->total() }}</div>
                        <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $produtos->count() }}</div>
                    </div>
                    
                    @if(count($produtos) > 0)

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Estabelecimento</th>
                                        <th>Categoria do Produto</th>
                                        <th>Nome do produto</th>
                                        <th>Valor</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($produtos as $produto)
                                    <tr>
                                    <td>{{ $produto->estabelecimento->nome }}</td>    
                                    <td>{{ $produto->categoriaProduto->nome }}</td>  
                                    <td>{{ $produto->nome }}</td>                                        
                                    <td>R$ {{ floatToMoney($produto->valor) }}</td>      
                                        <td class="text-center d-flex">
                                            <a class="text-white mr-1" href="{{ route('produto.edit', $produto->id) }}"><button class="btn btn-primary"><i class="fa fa-edit"></i> </button></a>
                                            <a href="#" onclick="$('#form_exclusao').attr('action', '{{ route('produto.destroy', $produto->id) }}')" data-toggle="modal" data-target="#modalConfirmDestroy"><button class="btn btn-danger"><i class="fa fa-times"></i> </button></a>
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
                            <div class="col-md-6">Qtde. registros: {{ $produtos->total() }}</div>
                            <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $produtos->count() }}</div>
                        </div>
                        <div class="d-flex justify-content-center">{{ $produtos->links() }}</div>
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
            $('.select').val("");                  
        }
    </script>
@stop