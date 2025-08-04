const ctx = document.getElementById('myChart');

 new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green'],
      datasets: [{
        label: '# of Votes',
        data: [12,16,11,67],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });


  
const salesGraph = document.getElementById("sales_graph");

const data = {
  labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
  datasets: [{
    label: 'Sales',
    data: [1200, 5000, 1800, 12223, 16000, 32444, 28999, 1222, 190, 12888,12344, 12239],
    fill: true,
    borderColor: 'rgb(75, 192, 192)',
    backgroundColor: 'rgba(75, 192, 192, 0.2)',
    tension: 0.4
  }]
};

const config = {
  type: 'line',
  data: data,
  options: {
    scales: {
      y: {
        beginAtZero: false
      }
    }
  }
};

new Chart(salesGraph, config);

