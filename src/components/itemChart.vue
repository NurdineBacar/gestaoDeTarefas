<template>
  <div class="row" id="box">
    <h5 class="pt-3" id="title">{{ titulo }}</h5>
    <h3 id="value">{{ val }}</h3>
    <div class="col-md" id="chart">
      <canvas ref="myChart"></canvas>
    </div>
  </div>
</template>
  
  <script>
import { Chart, registerables } from "chart.js";

// Registre todos os componentes necessários
Chart.register(...registerables);

export default {
  name: "circleChart",
  data() {
    return {
      chartData: {
        labels: this.lbs,
        datasets: [
          {
            label: "My First dataset",
            backgroundColor: ["#0D6EFD", "#b1dcff"],
            data: this.dados,
          },
        ],
      },
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: true,
            position: "left", // Define a posição da legenda como esquerda
            align: "center", // Alinha as labels da legenda ao início
            labels: {
              usePointStyle: true, // Usa estilo de ponto para labels
              padding: 8, // Espaçamento entre os itens da legenda
              boxWidth: 20,
              font: {
                        size: 11
                    }
            },
          },
          tooltip: {
            callbacks: {
              label: function (tooltipItem) {
                return `${tooltipItem.label}: ${tooltipItem.raw}`;
              },
            },
          },
        },
      },
    };
  },
  mounted() {
    this.createChart();
  },
  methods: {
    createChart() {
      new Chart(this.$refs.myChart, {
        type: "doughnut", // Tipo de gráfico
        data: this.chartData,
        options: this.chartOptions,
      });
    },
  },
  props: {
    titulo: String,
    val: Number,
    dados: Array,
    lbs: {
      type: Array,
      required: true,
    },
  },
};
</script>
  
  <style scoped>
#box {
  width: 180px;
  border-radius: 10px;
  background: white;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
  height: 180px;
}

#title {
  font-size: 13px;
  /* text-align: center; */
  margin-left: 7px;
}

#value {
  font-size: 35px;
  /* text-align: right; */
  margin-left: 10px;
  margin-top: -15px;
}

#chart {
  margin-left: -5px;
  height: 80px;
}

canvas {
  max-width: 100%;
  height: auto;
}
</style>
  