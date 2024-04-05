fetch('ConteoDia')
.then(response => response.json())
.then(data => {
    var colors = [
        'rgba(255, 159, 64, 0.2)', // Lunes
        'rgba(255, 99, 132, 0.2)', // Martes
        'rgba(54, 162, 235, 0.2)', // Miercoles
        'rgba(255, 206, 86, 0.2)', // Jueves
        'rgba(75, 192, 192, 0.2)', // Viernes
        'rgba(153, 102, 255, 0.2)', // Sabado
        'rgba(255, 159, 64, 0.2)' // Domingo
    ];

    var ctx = document.getElementById('conteodias').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Numero de Reportes Por Dia',
                data: data.dia.map(item => item.count),
                backgroundColor: colors,
                borderColor: colors.map(color => color.replace('0.2', '1')),
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
});
