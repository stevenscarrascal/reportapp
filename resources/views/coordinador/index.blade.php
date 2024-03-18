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
                    <!--Tabs navigation-->
                    <ul class="mb-5 flex list-none flex-row flex-wrap border-b-0 ps-0" role="tablist" data-twe-nav-ref>
                        <li role="presentation" class="flex-auto text-center">
                            <a href="#pendientes"
                                class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[twe-nav-active]:border-primary data-[twe-nav-active]:text-primary dark:text-white/50 dark:hover:bg-neutral-700/60 dark:data-[twe-nav-active]:text-primary"
                                data-twe-toggle="pill" data-twe-target="#pendientes" data-twe-nav-active role="tab"
                                aria-controls="pendientes" aria-selected="true">Pendientes</a>
                        </li>
                        <li role="presentation" class="flex-auto text-center">
                            <a href="#rechazados"
                                class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[twe-nav-active]:border-primary data-[twe-nav-active]:text-primary dark:text-white/50 dark:hover:bg-neutral-700/60 dark:data-[twe-nav-active]:text-primary"
                                data-twe-toggle="pill" data-twe-target="#rechazados" role="tab"
                                aria-controls="rechazados" aria-selected="false">Rechazados</a>
                        </li>
                        <li role="presentation" class="flex-auto text-center">
                            <a href="#revisados"
                                class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[twe-nav-active]:border-primary data-[twe-nav-active]:text-primary dark:text-white/50 dark:hover:bg-neutral-700/60 dark:data-[twe-nav-active]:text-primary"
                                data-twe-toggle="pill" data-twe-target="#revisados" role="tab"
                                aria-controls="revisados" aria-selected="false">Revisados</a>
                        </li>
                    </ul>

                    <!--Tabs content-->
                    <div class="mb-6">
                        <div class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                            id="pendientes" role="tabpanel" aria-labelledby="tabs-home-tab01" data-twe-tab-active>
                            <table id="tablependientes" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Contrato</th>
                                        <th>Lectura</th>
                                        <th>Fecha</th>
                                        <th>Direccion</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendientes as $pendiente)
                                        <tr>
                                            <td>{{ $pendiente->personal->nombres }}</td>
                                            <td>{{ $pendiente->personal->apellidos }}</td>
                                            <td>{{ $pendiente->contrato }}</td>
                                            <td>{{ $pendiente->lectura }}</td>
                                            <td>{{ $pendiente->created_at }}</td>
                                            <td>{{ $pendiente->direccion }}</td>
                                            <td>
                                                @if ($pendiente->estado == 7)
                                                    <strong class="text-white bg-yellow-500 rounded px-2 py-1">
                                                        {{ $pendiente->EstadoReporte->nombre }}
                                                    </strong>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('coordinador.show', $pendiente->id) }}"
                                                    class="btn btn-sm btn-primary  mb-1"><i class="far fa-eye"></i></a>

                                                <a href="{{ route('coordinador.edit', $pendiente->id) }}"
                                                    class="btn btn-sm btn-warning "><i class="far fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                            id="rechazados" role="tabpanel" aria-labelledby="rechazados">
                            Tab 2 content
                        </div>
                        <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                            id="revisados" role="tabpanel" aria-labelledby="revisados">
                            Tab 3 content
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('js')
        <script>
            $(document).ready(function() {
                var table = $('#tablependientes').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'excel',
                            text: '<i class="fas fa-file-excel"></i> Excel', // Agrega un icono de Excel antes del texto
                            className: 'btn btn-success'
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fas fa-file-pdf"></i> PDF', // Agrega un icono de PDF antes del texto
                            className: 'btn btn-danger'
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print"></i> Imprimir', // Agrega un icono de impresora antes del texto
                            className: 'btn btn-info'
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
