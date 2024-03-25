@if($eSuperAdmin)
    <a class="btn btn-primary btn-xs" href="{{ route('forma-pagamento.create') }}">
        <i class="fas fa-coins"></i> Adicionar Forma de Pagamento
    </a>
@endif

<ul class="nav nav-tabs mt-3" id="tabFormaPagamento" role="tablist">
    @foreach($tipoFormaPagamentos as $tipoFormaPagamento)
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $tipoFormaPagamento->id == 1 ? 'active' : '' }}" id="{{ $tipoFormaPagamento->id }}-tab" data-toggle="tab" href="#tab-formapagamento-{{ $tipoFormaPagamento->id }}" role="tab" aria-controls="{{ $tipoFormaPagamento->id }}" aria-selected="true">{{ $tipoFormaPagamento->nome }}</a>
        </li>
    @endforeach
</ul>

<div class="tab-content">
    @foreach($tipoFormaPagamentos as $tipoFormaPagamento)
        <div class="tab-pane {{ $tipoFormaPagamento->id == 1 ? 'active' : '' }}" id="tab-formapagamento-{{ $tipoFormaPagamento->id }}" role="tabpanel" aria-labelledby="{{ $tipoFormaPagamento->id }}-tab">
            @if(isset($tipoFormaPagamento->formasPagamento))
                <ul style="list-style: none;">
                    @foreach($tipoFormaPagamento->formasPagamento as $formaPagamento)
                        <li>
                            <label for="estabelecimentoFormaPagamento{{ $formaPagamento->id }}">

                                @php
                                    $checked = "";
                                    if(in_array($formaPagamento->id, $formaPagamentoEstabelecimentos)) {
                                        $checked = "checked='true'";
                                    }
                                @endphp

                                <input type="checkbox" name="estabelecimento_forma_pagamento[]" id="estabelecimentoFormaPagamento{{ $formaPagamento->id }}" value="{{ $formaPagamento->id }}" {{ $checked }}>
                                
                                @if(!empty($formaPagamento->foto))
                                    <img src="{{ asset("storage/$formaPagamento->foto") }}" style="max-width: 50px;">
                                @endif
        
                                {{ $formaPagamento->nome }}
                            </label>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endforeach
</div>