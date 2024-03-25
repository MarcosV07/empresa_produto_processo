<div class="d-flex justify-content-center">{{ $pedidos->links() }}</div>
                        <div class="row">
                            <div class="col-md-6">Qtde. registros: {{ $pedidos->total() }}</div>
                            <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $pedidos->count() }}</div>
                        </div>
                        
                        @if(count($pedidos) > 0)

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Estabelecimento</th>
                                            <th>Produto</th>                                                                                
                                            <th>Cliente</th>
                                            <th>Valor</th>
                                            <th>Status do pedido</th>
                                            <th>Dt. Inclusão</th>                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pedidos as $pedido)
                                        <tr>
                                            <td>{{ $pedido->estabelecimento->nome }}</td>                                        
                                            <td>{{ $pedido->produto->nome }}</td>
                                            <td>{{ $pedido->cliente->nome }}</td>
                                            <td>R$ {{ floatToMoney($pedido->valor_pedido) }}</td>
                                            <td>{{ $pedido->statusPedido->nome }}</td>
                                            <td>{{ Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y H:i:s') }}</td>                                                                                                                                   
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
                                <div class="col-md-6">Qtde. registros: {{ $pedidos->total() }}</div>
                                <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $pedidos->count() }}</div>
                            </div>
                            <div class="d-flex justify-content-center">{{ $pedidos->links() }}</div>
                        @else
                            <div class="alert alert-info"><i class="fas fa-exclamation"></i> Nenhum dado localizado para os parâmetros indicados.</div>
                        @endif