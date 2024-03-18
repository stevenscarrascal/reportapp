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
                    <div class="flex justify-between items-center">
                        <a href="{{ route('reportes.create') }}"
                            class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none mb-2"
                            data-twe-toggle="tooltip" data-twe-placement="top" data-twe-ripple-init
                            data-twe-ripple-color="light" title="Agregar Nuevo Reporte">
                            <i class="fas fa-folder-plus"></i> Agregar Reporte
                        </a>
                    </div>
                    <!-- Versión de escritorio -->
                    <div class="hidden sm:block overflow-auto">
                        <table id="agente" class="w-full stripe order-column row-border compact hover"
                            style="width:100%">
                            <!-- Encabezado de la tabla -->
                            <thead>
                                <tr>
                                    <th>Contrato</th>
                                    <th>Fecha y hora</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <!-- Cuerpo de la tabla -->
                            <tbody>
                                @foreach ($historiales as $historial)
                                    <tr>
                                        <td>N°: {{ $historial->contrato }}</td>
                                        <td>{{ $historial->created_at }}</td>
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
                                                class="inline-block rounded bg-success p-2 text-white uppercase transition duration-150 ease-in-out hover:bg-green-500 focus:outline-none focus:ring-0 active:bg-green-600"><i
                                                    class="far fa-eye"></i>
                                            </a>
                                            @if ($historial->estado == 9)
                                                <a href="{{ route('reportes.edit', $historial->id) }}"
                                                    class="inline-block rounded bg-warning p-2 text-white uppercase transition duration-150 ease-in-out hover:bg-yellow-500 focus:outline-none focus:ring-0 active:bg-yellow-600"><i
                                                        class="far fa-edit"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="block sm:hidden">
                        <!-- Versión móvil -->
                        @if ($historiales->isEmpty())
                            <div class="text-center py-3">
                                <p class="text-gray-500">No hay reportes activos</p>
                            </div>
                        @endif
                        @foreach ($historiales as $historial)
                            <div
                                class="block  mb-2 rounded-lg bg-white p-6 text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-white">
                                <h5 class="mb-2 text-xl font-medium leading-tight">Contrato N°:
                                    {{ $historial->contrato }}</h5>
                                <p class="mb-2 text-base">Fecha y hora: {{ $historial->created_at }}</p>
                                <p class="mb-2 text-base">Estado: @switch($historial->EstadoReporte->id)
                                        @case(7)
                                            <strong class="text-white bg-yellow-500 rounded px-2 py-1">
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
                                    class="inline-block rounded bg-success p-2 text-white uppercase transition duration-150 ease-in-out hover:bg-green-500 focus:outline-none focus:ring-0 active:bg-green-600"><i
                                        class="far fa-eye"></i>
                                </a>
                                @if ($historial->estado == 9)
                                    <a href="{{ route('reportes.edit', $historial->id) }}"
                                        class="inline-block rounded bg-warning p-2 text-white uppercase transition duration-150 ease-in-out hover:bg-yellow-500 focus:outline-none focus:ring-0 active:bg-yellow-600"><i
                                            class="far fa-edit"></i></a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script>
            $(document).ready(function() {
                var table = $('#agente').DataTable({
                    dom: 'ftip',
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
