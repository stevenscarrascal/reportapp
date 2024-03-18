<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial de Registros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="table-responsive">
                        <div class="flex justify-between items-center">
                            <a href="{{ route('reportes.create') }}" class="btn btn-primary mb-1"
                                data-twe-toggle="tooltip" data-twe-placement="top" data-twe-ripple-init
                                data-twe-ripple-color="light" title="Agregar Nuevo Reporte">
                                <i class="fas fa-folder-plus"></i> Agregar Reporte
                            </a>
                        </div>
                        <!-- Versión de escritorio -->
                        <div class="d-none d-sm-block table-responsive">
                            <table id="example" class="table align-middle" style="width:100%">
                                <!-- Encabezado de la tabla -->
                                <thead>
                                    <tr>
                                        <th>
                                            Contrato</th>
                                        <th>
                                            Fecha y hora</th>
                                        <th>
                                            Estado
                                        </th>
                                        <th>
                                            Accion
                                        </th>
                                    </tr>
                                </thead>
                                <!-- Cuerpo de la tabla -->
                                <tbody>
                                    <div class="d-none d-sm-block table-responsive">
                                        @foreach ($historiales as $historial)
                                            <tr>
                                                <td>
                                                    N°: {{ $historial->contrato }}

                                                </td>
                                                <td>
                                                    {{ $historial->created_at }}
                                                </td>
                                                <td>
                                                    @switch($historial->EstadoReporte->id)
                                                        @case(7)
                                                            <strong class="text-white bg-yellow-500 rounded px-2 py-1">
                                                                {{ $historial->EstadoReporte->nombre }}
                                                            </strong>
                                                        @break

                                                        @case(8)
                                                            <strong class="text-white bg-green-500 rounded px-2 py-1">
                                                                {{ $historial->EstadoReporte->nombre }}
                                                            </strong>
                                                        @break

                                                        @case(9)
                                                            <strong class="text-white bg-red-500 rounded px-2 py-1">
                                                                {{ $historial->EstadoReporte->nombre }}
                                                            </strong>
                                                        @break

                                                        @default
                                                            {{ $historial->EstadoReporte->nombre }}
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <a href="{{ route('reportes.show', $historial->id) }}"
                                                        class="btn btn-primary  mb-1"><i class="far fa-eye"></i> Ver
                                                    </a>
                                                    @if ($historial->estado == 9)
                                                        <a href="{{ route('reportes.edit', $historial->id) }}"
                                                            class="btn btn-warning "><i class="far fa-edit"></i>
                                                            Editar</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </div>

                                </tbody>
                            </table>
                        </div>
                        <div class="d-block d-sm-none">
                            <!-- Versión móvil -->
                            @if ($historiales->isEmpty())
                                <div class="text-center py-3">
                                    <p class="text-gray-500">No hay reportes activos</p>
                                </div>
                            @endif
                            @foreach ($historiales as $historial)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title"><strong>Contrato N°:</strong> {{ $historial->contrato }}
                                        </h5>
                                        <p class="card-text mb-2"><strong>Fecha y hora:</strong>
                                            {{ $historial->created_at }}</p>
                                        <p class="card-text mb-2"><strong>Estado:</strong>
                                            @switch($historial->EstadoReporte->id)
                                                @case(7)
                                                    <strong class="text-white bg-yellow-500 rounded px-2 py-1">
                                                        {{ $historial->EstadoReporte->nombre }}
                                                    </strong>
                                                @break

                                                @case(8)
                                                    <strong class="text-white bg-green-500 rounded px-2 py-1">
                                                        {{ $historial->EstadoReporte->nombre }}
                                                    </strong>
                                                @break

                                                @case(9)
                                                    <strong class="text-white bg-red-500 rounded px-2 py-1">
                                                        {{ $historial->EstadoReporte->nombre }}
                                                    </strong>
                                                @break

                                                @default
                                                    {{ $historial->EstadoReporte->nombre }}
                                            @endswitch
                                        </p>
                                        <a href="{{ route('reportes.show', $historial->id) }}"
                                            class="btn btn-primary">Ver</a>
                                        @if ($historial->estado == 9)
                                            <a href="{{ route('reportes.edit', $historial->id) }}"
                                                class="btn btn-secondary">Editar</a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('css')
        <style>
            .dt-button {
                background-color: #4CAF50;
                /* Cambia el color de fondo a verde */
                color: white;
                /* Cambia el color del texto a blanco */
            }
        </style>
    @endsection
    @section('js')
        <script>
            $(document).ready(function() {
                var table = $('#example').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'excel',
                            text: '<i class="fas fa-file-excel"></i> Excel', // Agrega un icono de Excel antes del texto
                            className: 'dt-button'
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fas fa-file-pdf"></i> PDF', // Agrega un icono de PDF antes del texto
                            className: 'dt-button'
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print"></i> Imprimir', // Agrega un icono de impresora antes del texto
                            className: 'dt-button'
                        }
                    ],
                    borderCollapse: true,
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros por página",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "Mostrando la página _PAGE_ de _PAGES_",
                        "infoEmpty": "No hay registros disponibles",
                        "infoFiltered": "(filtrado de _MAX_ registros totales)",
                        "search": "Buscar:",
                    }
                });
            });
        </script>
    @endsection
</x-app-layout>
