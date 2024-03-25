<div class="d-flex justify-content-center">{{ $produtos->links() }}</div>
                        <div class="row">
                            <div class="col-md-6">Qtde. registros: {{ $produtos->total() }}</div>
                            <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $produtos->count() }}</div>
                        </div>
                        
                        @if(count($produtos) > 0)

                        <div class="row">

                        @foreach($produtos as $produto)                                                                                        

                                <div class="card border-dark m-3" style="max-width: 18rem; min-width: 18rem">
                             
                                    <form role="form" method="POST" action="{{ route('pedido.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" id="estabelecimento_id" name="estabelecimento_id" value="{{$produto->estabelecimento->id}}">
                                        <input type="hidden" id="produto_id" name="produto_id" value="{{$produto->id}}">
                                        <input type="hidden" id="cliente_id" name="cliente_id" value="{{Auth::user()->cliente_id}}">
                                        <input type="hidden" id="status_pedido_id" name="status_pedido_id" value="1">
                                        <input type="hidden" id="valor_pedido" name="valor_pedido" value="{{$produto->valor}}"> 
                                            <div class="card-header">{{ $produto->nome }}</div>
                                            <div class="card-body text-dark">
                                                <h5 class="card-title"> </h5>
                                                <p class="card-text"><span style="font-size: 12px; font-weight: bold;" > Estabelecimento: </span>{{ $produto->estabelecimento->nome }}</p>                                                                            
                                                <p class="card-text"><span style="font-size: 12px; font-weight: bold;" > Categoria: </span>{{ $produto->categoriaProduto->nome }}</p>                                                                                                                                                                                               
                                                <p class="card-text"><span style="font-size: 12px; font-weight: bold;" > Valor: </span> R$ {{ floatToMoney($produto->valor) }}</p>  
                                                <p class="card-text">
                                                
                                                @if(Auth::user()->perfil_id == 3 && $saldoCliente >= $produto->valor)
                                                    <button type="submit" class="btn btn-success btn-sm">Comprar</button>
                                                @endif
                                                </p>  
                                            </div>                                                                               
                                    </form> 
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
                                <div class="col-md-6">Qtde. registros: {{ $produtos->total() }}</div>
                                <div class="col-md-6 text-right">Qtde. registros p/ página: {{ $produtos->count() }}</div>
                            </div>
                            <div class="d-flex justify-content-center">{{ $produtos->links() }}</div>
                        @else
                            <div class="alert alert-info"><i class="fas fa-exclamation"></i> Nenhum dado localizado para os parâmetros indicados.</div>
                        @endif
                        <br>
                            <div class="row">
                                <button type="button" onclick="window.location='{{ url()->previous() }}'" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</button>                      
                            </div>