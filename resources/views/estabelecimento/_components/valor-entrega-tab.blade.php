@if(empty($bairros) || $bairros->count() == 0)
    <div class="alert alert-warning" id="alertaBairroNaoHabilitado">
        <i class="fas fa-exclamation"></i> Estado/Cidade do Estabelecimento não indicado ou não possui habilitação para entregas.
    </div>
@endif

<button type="button" class="btn btn-xs btn-success mb-2 float-right" onclick="carregarBairros()"><i class="fas fa-retweet"></i> Restaurar Valores</button>
<div class="table-responsive" style="max-height: 300px; overflow: scroll;">
    <table class="table">
        <thead>
            <tr>
                <!-- <th>
                    <input type="checkbox" id="todosBairros" onclick="marcarBairros(this)" checked="true">
                </th> -->
                <th>
                    Bairro
                </th>
                <th>
                    Valor de Entrega (R$)
                </th>
            </tr>
        </thead>
        <tbody id="corpoTabelaValoreEntrega">
            @if(!empty($bairros) && $bairros->count() > 0)
                @foreach($bairros as $bairro)
                <tr>
                    <!-- <td scope="row">
                        <input type="checkbox" class="bairro" name="bairro_estabelecimento[{{ $bairro->id }}][id]" id="Bairro{{ $bairro->id }}" value="{{ $bairro->id }}" {{ isset($bairrosEstabelecimentos[$bairro->id]) && $bairrosEstabelecimentos[$bairro->id] > 0 ? "checked='true'" : "" }} />
                    </td> -->
                    <td>
                        <label for="Bairro{{ $bairro->id }}" style="font-weight: normal; cursor: pointer;">
                            {{ $bairro->bairro }}
                        </label>
                    </td>
                    <td>
                        <input type="text" class="form-control money" name="bairro_estabelecimento[{{ $bairro->id }}][valor_entrega]" placeholder="0,00" value="{{ isset($bairrosEstabelecimentos[$bairro->id]) && $bairrosEstabelecimentos[$bairro->id] > 0 ? floatToMoney($bairrosEstabelecimentos[$bairro->id]) : '' }}" />
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>