fetch('/informes/ConteoPersonal')
.then(response => response.json())
.then(data => {
    var colors = [
        'rgba(75, 192, 195, 0.2)', // Enero
        'rgba(54, 162, 235, 0.2)', // Febrero
        'rgba(255, 206, 86, 0.2)', // Marzo
        'rgba(75, 192, 192, 0.2)', // Abril
        'rgba(153, 102, 255, 0.2)', // Mayo
        'rgba(255, 159, 64, 0.2)', // Junio
        'rgba(255, 99, 132, 0.2)', // Julio
        'rgba(54, 162, 235, 0.2)', // Agosto
        'rgba(255, 206, 86, 0.2)', // Septiembre
        'rgba(75, 192, 192, 0.2)', // Octubre
        'rgba(153, 102, 255, 0.2)', // Noviembre
        'rgba(255, 159, 64, 0.2)' // Diciembre
    ];

    var ctx = document.getElementById('conteoxpersonal').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.names,
            datasets: [{
                label: 'Numero de Reportes Por Personal',
                data: data.data,
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
