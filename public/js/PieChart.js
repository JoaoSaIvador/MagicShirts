var ctx = document.getElementById("myAreaDoughnut");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ['Clientes', 'Funcionários', 'Administradores'],
    datasets: [{
      data: graph2.data,
      backgroundColor: ['#ff8533', '#ffff00', '#ff0000'],
      hoverBackgroundColor: ['#ff751a', '#e6e600', '#e60000'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
