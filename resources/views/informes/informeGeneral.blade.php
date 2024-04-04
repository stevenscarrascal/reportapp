@extends('dashboard.dashboard')


@section('content')
    <div class="row gap-1 mb-2">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div style="width:50%;">
                        <canvas id="conteomes" style="width:100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div style="width:100%;">
                        <canvas id="conteodias" style="width:100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row gap-1 ">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div style="width:80%;">
                        <canvas id="anomaliasXmes" style="width:100%;" ></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div style="width:80%;">
                        <canvas id="conteoxpersonal" style="width:100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        fetch('ConteoRegistros')
            .then(response => response.json())
            .then(data => {
                var colors = [
                    'rgba(255, 99, 132, 0.2)', // Enero
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

                var ctx = document.getElementById('conteomes').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Numero de Reportes Por Mes',
                            data: data.mes.map(item => item.count),
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
    </script>
    <script>
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
    </script>
    <script>
        fetch('anomaliasMes')
            .then(response => response.json())
            .then(data => {
                var colors = [
                    'rgba(255, 99, 132, 0.2)', // Enero
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
                let dataArray = Array.isArray(data.data) ? data.data : Object.keys(data.data).map(key => ({mes: key, anomalia: data.data[key]}));

                var ctx = document.getElementById('anomaliasXmes').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Numero de Anomalias Por mes',
                            data: dataArray.map(item => item.anomalia),
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
    </script>
    <script>
        fetch('ConteoPersonal')
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
    </script>

@endsection
