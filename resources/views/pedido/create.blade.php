@extends('adminlte::page')

@section('title', 'Comprar Produtos')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Comprar Produtos</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Comprar Produtos</li>
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
                <button class="btn btn-primary btn-xs float-right" onclick="window.location = '{{ route('pedido.create') }}'">
                    <i class="fa fa-plus"></i> Novo
                </button>
            </div>
              <div class="card-body">

             

              
              <form action="{{ route('pedido.create') }}" method="GET">
                        
                        <div class="row">
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
                    <br><br>
<!--                     <div class="alert alert-light" role="alert">
                       Saldo Atual: R$ {{ floatToMoney($saldoCliente) }}
                    </div> -->

                    <div class="info-box px-0">
                      <span class="info-box-icon bg-primary"><i class="fa fa-money-bill"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Saldo Atual</span>
                        <span class="info-box-number">R$ {{ floatToMoney($saldoCliente) }}</span>
                      </div>
                    </div>
                    
                    <br>
                    
                        @component('pedido._components.create-cliente', ["produtos" => $produtos, "saldoCliente" => $saldoCliente])
                        @endcomponent
                    
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