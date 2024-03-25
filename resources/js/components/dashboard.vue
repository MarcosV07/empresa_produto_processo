<template>
  <div class="card card-primary collapsed-card">
      <div class="card-header">
        <h3 class="card-title">DashBoard</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-plus"></i>
          </button>
        </div>
      </div>
      <div class="card-body" style="display:none">
        <div  class="row">
          <div class="col-md-6 border">
            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
          <div class="col-md-6 border">
            <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
</template>
  
  <script>

  import Chart from 'chart.js/auto';

  export default {
    props: {
      pedidos: {
        type: Array,
        default: () => []
      }
    },
    methods: {
      getPedidos() {
        if(this.pedidos.data){
          chartsDonut(this.pedidos.data)
          chartsline(this.pedidos.data)
        }
      }
    },
    mounted() {
      this.getPedidos();
    }
  }

  function chartsDonut(params) {
    var agrupadoPorEstabelecimento = agruparPorChave(params, 'estabelecimento_id');
    var labels = [];
    var data = [];

    for (var estabelecimentoId in agrupadoPorEstabelecimento) {
      if (agrupadoPorEstabelecimento.hasOwnProperty(estabelecimentoId)) {
        var nomeEstabelecimento = agrupadoPorEstabelecimento[estabelecimentoId][0].estabelecimento.nome;
        var quantidadeItens = agrupadoPorEstabelecimento[estabelecimentoId].length;
        
        labels.push(nomeEstabelecimento);
        data.push(quantidadeItens);
      }
    }

    var canvas = document.getElementById('donutChart');
    var ctx = canvas.getContext('2d');

    var donutData = {
      labels: labels,
      datasets: [
        {
          data: data,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    };

    var donutOptions = {
      maintainAspectRatio: false,
      responsive: true
    };

    new Chart(ctx, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    });
  
  }

  function chartsline(params) {
    var meses = [
        'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho',
        'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
    ];

    var areaChartData = {
        labels: meses,
        datasets: []
    };

    var indexCor = 0;
    var agrupadoPorEstabelecimento = agruparPorChave(params, 'estabelecimento_id');

    for (var estabelecimentoId in agrupadoPorEstabelecimento) {
      if (agrupadoPorEstabelecimento.hasOwnProperty(estabelecimentoId)) {
        var dadosEstabelecimento = agrupadoPorEstabelecimento[estabelecimentoId];

        var datasetEstabelecimento = {
            label: dadosEstabelecimento[0].estabelecimento.nome,
            backgroundColor: alternarCor(indexCor),
            borderColor: alternarCor(indexCor),
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: alternarCor(indexCor),
            pointHighlightFill: '#fff',
            pointHighlightStroke: alternarCor(indexCor),
            data: []
        };

        indexCor++;

        var contagemItensPorMes = Array(meses.length).fill(0);

        dadosEstabelecimento.forEach(function (dados) {
            var mes = extrairMes(meses, dados.created_at);
            var indiceMes = meses.indexOf(mes);
            if (indiceMes !== -1) {
                contagemItensPorMes[indiceMes]++;
            }
        });

        datasetEstabelecimento.data = contagemItensPorMes;
        areaChartData.datasets.push(datasetEstabelecimento);
      }
    }

    var areaChartOptions = {
      maintainAspectRatio: false,
      responsive: true,
      legend: {
        display: false
      },
      //scales: {xAxes: [{gridLines: {display: false,}}],yAxes: [{ gridLines: {display: false,}}]}
    };

    var canvas = document.getElementById('lineChart');
    var ctx = canvas.getContext('2d');

    var lineChartOptions = JSON.parse(JSON.stringify(areaChartOptions));
    var lineChartData = JSON.parse(JSON.stringify(areaChartData));

    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false;

    new Chart(ctx, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    });
  }

  function agruparPorChave(array, chave) {
    return array.reduce(function (acumulador, objeto) {
        var chaveValor = objeto[chave];
        if (!acumulador[chaveValor]) {
            acumulador[chaveValor] = [];
        }
        acumulador[chaveValor].push(objeto);
        return acumulador;
    }, {});
  }

  function extrairMes(mesesString, data) {
    var partes = data.split('-');
    var indiceMes = parseInt(partes[1]) - 1; // Converter o número do mês para o índice do array
    return mesesString[indiceMes];
  }

  function alternarCor(index) {
    var cores = [
        'rgba(60,141,188,0.9)',
        'rgba(210, 214, 222, 1)',
        'rgba(255, 99, 132, 0.9)',
        'rgba(54, 162, 235, 0.9)',
        'rgba(255, 159, 64, 0.9)',
        'rgba(75, 192, 192, 0.9)',
        'rgba(153, 102, 255, 0.9)',
        'rgba(255, 206, 86, 0.9)',
        'rgba(231, 233, 237, 0.9)',
        'rgba(255, 205, 86, 0.9)',
        'rgba(75, 192, 192, 0.9)',
        'rgba(153, 102, 255, 0.9)',
    ];

    return cores[index % cores.length];
  }
  </script>
  
  <style scoped>
  /* Estilos específicos para este componente */
  </style>
  