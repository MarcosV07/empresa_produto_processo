<template>
    <div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="cep">CEP <span class="asterisco">*</span></label>
            <input type="text" class="form-control cep" id="cep" name="cep" v-model="estabelecimento.cep" placeholder="CEP do Estabelecimento">
          </div>
        </div>
        <div class="col-md-4 form-inline">
          <div class="form-group mt-3">
            <button type="button" class="btn btn-primary" @click="getViaCep"><i class="fa fa-filter"></i> Pesquisar</button>
          </div>
        </div>
      </div>
  
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label for="logradouro">Logradouro <span class="asterisco">*</span></label>
            <input type="text" class="form-control" id="logradouro" name="logradouro" v-model="estabelecimento.logradouro" placeholder="Logradouro do Estabelecimento" @blur="getLatudeLongitude">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="bairro">Bairro <span class="asterisco">*</span></label>
            <input type="text" class="form-control" id="bairro" name="bairro" v-model="estabelecimento.bairro" placeholder="Bairro do Estabelecimento" @blur="getLatudeLongitude">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="cidade">Cidade <span class="asterisco">*</span></label>
            <input type="text" class="form-control" id="cidade" name="cidade" v-model="estabelecimento.cidade" placeholder="Cidade do Estabelecimento" @blur="getLatudeLongitude">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="estado">Estado <span class="asterisco">*</span></label>
            <input type="text" class="form-control" id="estado" name="estado" v-model="estabelecimento.estado" placeholder="Estado do Estabelecimento" @blur="getLatudeLongitude">
          </div>
        </div>
      </div>
  
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="complemento">Complemento</label>
            <input type="text" class="form-control" id="complemento" name="complemento" v-model="estabelecimento.complemento" placeholder="Complemento do Endereço">
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label for="referencia">Referência</label>
            <input type="text" class="form-control" id="referencia" name="referencia" v-model="estabelecimento.referencia" placeholder="Referência do Estabelecimento">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label for="numero">Número <span class="asterisco">*</span></label>
            <input type="text" class="form-control" id="numero" name="numero" v-model="estabelecimento.numero" placeholder="Nº do Estabelecimento" @blur="getLatudeLongitude">
          </div>
        </div>
      </div>
  
      <input type="hidden" id="latitude" name="latitude" v-model="estabelecimento.latitude">
      <input type="hidden" id="longitude" name="longitude" v-model="estabelecimento.longitude">
  
      <div id="map" style="width: 100%; height: 300px;"></div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
    estabelecimento: {
      type: Object,
      default: () => ({
        cep: '',
        logradouro: '',
        bairro: '',
        cidade: '',
        estado: '',
        complemento: '',
        referencia: '',
        numero: '',
        latitude: '',
        longitude: ''
      })
    }
  },
    methods: {
      getViaCep() {
        carregarDadosViaCep()
      },
      getLatudeLongitude() {
        buscaLatLong()
      }
    }
  }

  </script>
  
  <style scoped>
  /* Estilos específicos para este componente */
  </style>
  