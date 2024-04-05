@extends('dashboard.dashboard')

@section('content')
    <div class="row gap-1 mb-2">
        <x-filters />

        <div class="col">
            <div class="card">
                <div class="card-body">
                        <div id="container" style="width:100%; height:400px;"></div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
            <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                const reportes = {!! json_encode($reportes) !!};
                const chart = Highcharts.chart('container', {
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: 'Reportes totales Por mes'
                    },
                    xAxis: {
                        categories: ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto',
                            'septiembre', 'octubre', 'noviembre', 'diciembre']
                    },
                    yAxis: {
                        title: {
                            text: 'Cantidad de reportes'
                        }
                    },
                    series: [{
                        name: ['Numero de Reportes Por Mes'],
                        data: reportes.map(item => item.total)
                    }]
                });
            });
        </script>
    @endsection
