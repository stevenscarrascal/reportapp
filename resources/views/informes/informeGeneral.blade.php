@extends('dashboard.dashboard')

@section('content')
    <div class="row gap-1 mb-2">
        <x-filters />

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div style="width:70%;">
                        <canvas id="informeGeneral" style="width:100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
    <script>
        let chart;

        function getData() {
            $.ajax({
                url: '/informes/ConteoFilter',
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    personal: $('#personal').val(),
                    from: $('#from').val(),
                    to: $('#to').val()
                },
                success: function(response) {
                    const data = response.data;
                    const ctx = document.getElementById('informeGeneral').getContext('2d');

                    if (chart) {
                        chart.destroy();
                    }

                    if (data && Array.isArray(data) && data.length > 0) {
                        chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: data.map(d => d.nombre),
                                datasets: [{
                                    label: 'Cantidad de reportes',
                                    data: data.map(d => d.cantidad),
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    } else {
                        // Mostrar un mensaje o tomar alguna acción en caso de que no haya datos
                        console.error('No se encontraron datos válidos.');
                    }
                },
                error: function(err) {
                    console.error(err);
                }
            });
        }
    </script>

    @endsection
