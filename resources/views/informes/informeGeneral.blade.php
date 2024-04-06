@extends('dashboard.dashboard')

@section('content')
    <div class="row gap-1 mb-2">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div id="container" style="width:100%; height:400px;"></div>
                    <a class="btn btn-outline-primary " id="pdf"> Descargar Pdf</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                {{-- <a href="https://www.google.com/maps/place/{{$latitud.','$longitud}}">Maps</a> --}}
                  <a href="https://www.google.com/maps/place/10.404569,-75.521145" target="_blank" class="btn btn-primary ">Maps</a>
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
                    title: {
                        text: 'Año 2024'
                    }
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

         // Activate the custom button
         document.getElementById('pdf').addEventListener('click', function() {
            Highcharts.charts[0].exportChart({
                type: 'application/pdf'
            });
        });
    </script>

@endsection
