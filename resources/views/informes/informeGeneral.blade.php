@extends('dashboard.dashboard')

@section('content')
    <div class="row gap-1 mb-2">
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
                        categories: reportes.map(item => item.month)
                    },
                    yAxis: {
                        title: {
                            text: 'Cantidad de reportes'
                        }
                    },

                    series: reportes.map((item, index) => ({
                        name: item.month,
                        data: [item.total],
                        color: Highcharts.getOptions().colors[
                            index] // Asigna un color diferente a cada barra
                    }))
                });
            });
        </script>
    @endsection
