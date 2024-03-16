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
                            <h1 class="text-lg font-bold text-gray-800 mb-3">Reportes Activos</h1>
                            <a href="{{ route('reportes.create') }}"
                                class="bg-blue-600 text-center mb-2 text-white hover:text-blue-800 rounded px-4 py-1 inline-block sm:px-2 sm:py-2"
                                data-twe-toggle="tooltip" data-twe-placement="top" data-twe-ripple-init
                                data-twe-ripple-color="light" title="Agregar Nuevo Reporte">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                                </svg>
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
                                            <p>Accion</p>
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
                                                        class="bg-blue-600 text-white hover:text-blue-800 mr-1 rounded px-4 py-1 inline-block sm:px-2 sm:py-2 mb-1">Ver</a>
                                                    @if ($historial->estado == 9)
                                                        <a href="{{ route('reportes.edit', $historial->id) }}"
                                                            class="bg-green-600 hover:text-green-900 rounded px-2 py-1 inline-block sm:px-2 sm:py-2 text-white">Editar</a>
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

    @section('js')
        <script>
            $(document).ready(function() {
                $('#example').DataTable({
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
