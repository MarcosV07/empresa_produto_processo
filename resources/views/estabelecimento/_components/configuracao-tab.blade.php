<div class="row">

    <div class="col-md-4">
      <div class="form-group">
        <label for="arquivo_logotipo">Logotipo</label>
        <input type="file" name="arquivo_logotipo" id="arquivo_logotipo" class="form-control"/>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="arquivo_fundo_cabecalho">Imagem de Fundo</label>
        <input type="file" name="arquivo_fundo_cabecalho" id="arquivo_fundo_cabecalho" class="form-control"/>
      </div>
    </div>

</div>

<div class="row">

    <div class="col-md-12">
        <div class="form-group">
          <label for="valor_minimo_pedido">Valor Mínimo para pedidos (R$)</label>
          <x-adminlte-input type="text" class="money" id="valor_minimo_pedido" name="valor_minimo_pedido" placeholder="Valor Mínimo para pedidos" value="{{ $estabelecimento->valor_minimo_pedido ?? old('valor_minimo_pedido') }}" />
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
          <label for="permite_retirada">Permitir retirada na loja ?</label>
          <input type="checkbox" id="permite_retirada" name="permite_retirada" {{ ($estabelecimento->permite_retirada ?? old('permite_retirada') === true ? "checked='checked'" : "") }} />
        </div>
    </div>
    
</div>