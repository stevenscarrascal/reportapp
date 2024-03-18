<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial de Registros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
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
                            <table id="tablecoordinador" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Contrato</th>
                                        <th>Lectura</th>
                                        <th>Coordenadas</th>
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
                                            <td>{{ $pendiente->latitud . ',' . $revisado->longitud }}</td>
                                            <td>{{ $pendiente->created_at }}</td>
                                            <td>{{ $pendiente->direccion }}</td>
                                            <td>
                                                @if ($pendiente->estado == 7)
                                                    <strong class="text-white bg-yellow-500 rounded px-2 py-1">
                                                        Pendiente
                                                    </strong>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('coordinador.show', $pendiente->id) }}"
                                                    class="inline-block rounded bg-success p-2 text-white uppercase transition duration-150 ease-in-out hover:bg-green-500 focus:outline-none focus:ring-0 active:bg-green-600 mb-1"><i
                                                        class="far fa-eye"></i></a>

                                                <a href="{{ route('coordinador.edit', $pendiente->id) }}"
                                                    class="inline-block rounded bg-warning p-2 text-white uppercase transition duration-150 ease-in-out hover:bg-yellow-500 focus:outline-none focus:ring-0 active:bg-yellow-600"><i
                                                        class="far fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                            id="rechazados" role="tabpanel" aria-labelledby="rechazados">
                            <table id="tablecoordinador2" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Contrato</th>
                                        <th>Lectura</th>
                                        <th>Coordenadas</th>
                                        <th>Fecha</th>
                                        <th>Direccion</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rechazados as $rechazado)
                                        <tr>
                                            <td>{{ $rechazado->personal->nombres }}</td>
                                            <td>{{ $rechazado->personal->apellidos }}</td>
                                            <td>{{ $rechazado->contrato }}</td>
                                            <td>{{ $rechazado->lectura }}</td>
                                            <td>{{ $rechazado->latitud . ',' . $revisado->longitud }}</td>
                                            <td>{{ $rechazado->created_at }}</td>
                                            <td>{{ $rechazado->direccion }}</td>
                                            <td>
                                                @if ($rechazado->estado == 9)
                                                    <strong class="text-white bg-danger rounded px-2 py-1">
                                                        Rechazado
                                                    </strong>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('coordinador.show', $rechazado->id) }}"
                                                    class="inline-block rounded bg-success p-2 text-white uppercase transition duration-150 ease-in-out hover:bg-green-500 focus:outline-none focus:ring-0 active:bg-green-600 mb-1"><i
                                                        class="far fa-eye"></i></a>

                                                <a href="{{ route('coordinador.edit', $rechazado->id) }}"
                                                    class="inline-block rounded bg-warning p-2 text-white uppercase transition duration-150 ease-in-out hover:bg-yellow-500 focus:outline-none focus:ring-0 active:bg-yellow-600"><i
                                                        class="far fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                            id="revisados" role="tabpanel" aria-labelledby="revisados">
                            <table id="tablecoordinador3" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Contrato</th>
                                        <th>Lectura</th>
                                        <th>Coordenadas</th>
                                        <th>Fecha</th>
                                        <th>Direccion</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($revisados as $revisado)
                                        <tr>
                                            <td>{{ $revisado->personal->nombres }}</td>
                                            <td>{{ $revisado->personal->apellidos }}</td>
                                            <td>{{ $revisado->contrato }}</td>
                                            <td>{{ $revisado->lectura }}</td>
                                            <td>{{ $revisado->latitud . ',' . $revisado->longitud }}</td>
                                            <td>{{ $revisado->created_at }}</td>
                                            <td>{{ $revisado->direccion }}</td>
                                            <td>
                                                @if ($revisado->estado == 8)
                                                    <strong class="text-white bg-success rounded px-2 py-1">
                                                        Revisado
                                                    </strong>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('coordinador.show', $revisado->id) }}"
                                                    class="inline-block rounded bg-success p-2 text-white uppercase transition duration-150 ease-in-out hover:bg-green-500 focus:outline-none focus:ring-0 active:bg-green-600 mb-1"><i
                                                        class="far fa-eye"></i></a>

                                                <a href="{{ route('coordinador.edit', $revisado->id) }}"
                                                    class="inline-block rounded bg-warning p-2 text-white uppercase transition duration-150 ease-in-out hover:bg-yellow-500 focus:outline-none focus:ring-0 active:bg-yellow-600"><i
                                                        class="far fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('js')
        <script>
            $(document).ready(function() {
                var table = $('#tablecoordinador,#tablecoordinador2,#tablecoordinador3').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'excel',
                            text: '<i class="fas fa-file-excel"></i> Excel', // Agrega un icono de Excel antes del texto
                            className: 'bg-sinline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none mb-2uccess'
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fas fa-file-pdf"></i> PDF', // Agrega un icono de PDF antes del texto
                            className: 'inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none mb-2'
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print"></i> Imprimir', // Agrega un icono de impresora antes del texto
                            className: 'inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none mb-2'
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
