fetch('/informes/anomaliasMes')
.then(response => response.json())
.then(data => {
    var colors = [
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
    ];
    const ctx = document.getElementById('anomaliasActual').getContext('2d');
    // Extraemos los nombres y los conteos de los datos
    const labels = data.data.map(item => item.nombre);
    const conteo = data.data.map(item => item.count);
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Anomalías Detectadas del Día',
                data: conteo,
                backgroundColor: colors,
                borderColor: colors,
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
