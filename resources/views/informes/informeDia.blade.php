@extends('dashboard.dashboard')

@section('content')
    <div class="row mb-2">
        <div class="col-md-4 ">
            <div class="card shadow ">
                <div class="card-body">
                    <div id="dia" style="width:100%; height:400px;"></div>
                    <a class="btn btn-outline-primary " id="pdf"> Descargar Pdf</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 ">
            <div class="card shadow">
                <div class="card-body">
                    <div id="anomalias" style="width:100%; height:400px;"></div>
                    <a class="btn btn-outline-primary " id="anomaliaspdf"> Descargar Pdf</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow ">
                <div class="card-body">
                    <div id="personals" style="width:100%; height:400px;"></div>
                    <a class="btn btn-outline-primary " id="personalspdf"> Descargar Pdf</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col ">
            <x-busqueda />
            <div class="card shadow ">
                <div class="card-body">
                    <div id="filters" style="width:100%; height:400px;"></div>
                    <a class="btn btn-outline-primary " id="pdf"> Descargar Pdf</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function getData() {
            $.ajax({
                url: '/informes/filtro',
                type: 'GET',
                dataType: 'json',
                data: {
                    personal: $('#personal').val(),
                    desde: $('#desde').val(),
                    hasta: $('#hasta').val()
                },
                success: function(data) {
                    var seriesData = data.map(function(item) {
                        return item.total;
                    });
                    var seriesDate = data.map(function(item) {
                        return item.fecha;
                    });

                    Highcharts.chart('filters', {
                        chart: {
                            type: 'line'
                        },
                        title: {
                            text: 'Historial de reportes'
                        },
                        subtitle: {
                            text: 'Por fecha y personal de lectura'
                        },
                        xAxis: {
                            categories: seriesDate // Usar las fechas convertidas como categorías
                        },
                        yAxis: {
                            title: {
                                text: 'Cantidad de reportes por día'
                            }
                        },
                        plotOptions: {
                            line: {
                                dataLabels: {
                                    enabled: true
                                },
                                enableMouseTracking: false
                            }
                        },
                        series: [{
                            name: 'Historial de reportes, por fecha y personal de lectura',
                            data: seriesData
                        }]
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>

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
        // Activate the custom button
        document.getElementById('pdf').addEventListener('click', function() {
            Highcharts.charts[0].exportChart({
                type: 'application/pdf'
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
        // Activate the custom button
        document.getElementById('anomaliaspdf').addEventListener('click', function() {
            Highcharts.charts[1].exportChart({
                type: 'application/pdf'
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const personaldata = {!! json_encode($personals) !!};
            const dia = {!! json_encode($today) !!};
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
                            format: '{point.y}',
                            style: {
                                fontSize: '1.2em',
                                textOutline: 'none',
                                opacity: 0.7
                            },
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

        // Activate the custom button
        document.getElementById('personalspdf').addEventListener('click', function() {
            Highcharts.charts[2].exportChart({
                type: 'application/pdf'
            });
        });
    </script>
@endsection
