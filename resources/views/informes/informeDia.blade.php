@extends('dashboard.dashboard')

@section('content')
    <div class="row gap-1 mb-2">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div id="dia" style="width:100%; height:400px;"></div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div id="anomalias" style="width:100%; height:400px;"></div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div id="personals" style="width:100%; height:400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row gap-1 ">

    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const data = {!! json_encode($dia) !!};
            const diasSemana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
            const colors = Highcharts.getOptions().colors.slice(0, data.length);
            Highcharts.chart('dia', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Reportes Semanales'
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        autoRotation: [-45, -90],
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Cantidad de Reportes'
                    }
                },
                legend: {
                    enabled: false
                },
                series: [{
                    name: 'Lecuras por día',
                    colors: colors,
                    colorByPoint: true,
                    groupPadding: 0,
                    data: data.map(item => [item.day, item.count]),
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        inside: true,
                        verticalAlign: 'top',
                        format: '{point.y:.1f}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }]
            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const data = {!! json_encode($anomalies) !!};

            // Definir una paleta de colores para las anomalías
            const colors = Highcharts.getOptions().colors.slice(0, data.length);

            Highcharts.chart('anomalias', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total de Anomalías Detectadas',
                    align: 'left'
                },
                xAxis: {
                    categories: data.map(item => item.nombre),
                    crosshair: true,
                    accessibility: {
                        description: 'Anomalías'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Cantidad de Anomalías Detectadas'
                    }
                },
                tooltip: {
                    valueSuffix: ' Anomalías'
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: data.map((item, index) => ({
                    name: item.nombre,
                    data: [{
                        y: item.count
                    }],
                    color: colors[index]
                }))
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const personaldata = {!! json_encode($personals) !!};
            const colors = Highcharts.getOptions().colors.slice(0, personaldata.length);


            Highcharts.chart('personals', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Reportes por Personal de lectura'
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: [{
                            enabled: true,
                            distance: 20
                        }, {
                            enabled: true,
                            distance: -40,
                            format: '{point.percentage:.1f}',
                            style: {
                                fontSize: '1.2em',
                                textOutline: 'none',
                                opacity: 0.7
                            },
                            filter: {
                                operator: '>',
                                property: 'percentage',
                                value: 10
                            }
                        }]
                    }
                },
                series: [{
                    name: 'Total Reportes',
                    colorByPoint: true,
                    data: personaldata.map(item => ({
                        name: item.personal_name,
                        y: item.count,
                        color: colors[personaldata.indexOf(item)]
                    }))
                }]
            });

        })
    </script>
@endsection
