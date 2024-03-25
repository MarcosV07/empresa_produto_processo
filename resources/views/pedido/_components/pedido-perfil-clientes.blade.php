        <div class="d-flex justify-content-center">{{ $pedidos->links() }}</div>
                        <div class="row">
                            <div class="col-md-6">Qtde. registros: {{ $pedidos->total() }}</div>
                            <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $pedidos->count() }}</div>
                        </div>
                        
                        @if(count($pedidos) > 0)

                        <div class="row">

                        @foreach($pedidos as $pedido)
                               
                                <div class="card border-dark m-3" style="max-width: 18rem; min-width: 18rem">
                                    <div class="card-header">{{ $pedido->produto->nome }}</div>
                                    <div class="card-body text-dark">
                                        <h5 class="card-title">  </h5>
                                        <p class="card-text">    <span style="font-size: 12px; font-weight: bold;" > Estabelecimento: </span>{{ $pedido->estabelecimento->nome }}</p>                                    
                                        <p class="card-text"><span style="font-size: 12px; font-weight: bold;" > Valor: </span> R$ {{ floatToMoney($pedido->valor_pedido) }}</p>   
                                        <p class="card-text"><span style="font-size: 12px; font-weight: bold;" > Data da compra: </span> {{ Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y H:i:s') }}</p>   
                                        
                                        <p class="card-text"><small class="text-muted"><span style="font-size: 12px; font-weight: bold;" > Status: </span> {{ $pedido->statusPedido->nome }}</small></p>                                                                                
                                    </div>
                                </div>
                                                                 
                            @endforeach
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