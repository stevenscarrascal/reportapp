<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-gray-800 leading-tight">
                {{ __('Agentes de Campo') }}
            </h2>
            <a href="{{ route('coordinador.index') }}"
                class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none mb-2">
                <i class="fas fa-arrow-left"></i> Regresar
            </a>
        </div>
        <!--Verically centered scrollable modal-->
        <div data-twe-modal-init
            class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
            id="nuevoagente" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableLabel" aria-modal="true"
            role="dialog">
            <div data-twe-modal-dialog-ref
                class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[800px]">
                <div
                    class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none dark:bg-surface-dark">
                    <div
                        class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4 dark:border-white/10">
                        <!-- Modal title -->
                        <h5 class="text-xl font-medium leading-normal text-surface dark:text-white"
                            id="exampleModalCenteredScrollableLabel">
                            Agragar Nuevo Agente de Campo
                        </h5>
                        <!-- Close button -->
                        <button type="button"
                            class="box-content rounded-none border-none text-neutral-500 hover:text-neutral-800 hover:no-underline focus:text-neutral-800 focus:opacity-100 focus:shadow-none focus:outline-none dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                            data-twe-modal-dismiss aria-label="Close">
                            <span class="[&>svg]:h-6 [&>svg]:w-6">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </span>
                        </button>
                    </div>
                    <!-- Modal body -->

                    <form action="{{ route('personals.store') }}" method="POST" class="mt-3">
                        @csrf
                        <div class="px-4">
                            <div class="grid gap-6 mb-6 md:grid-cols-2 px-4">
                                <div>
                                    <label for="tipo_documento"
                                        class="block mb-2 text-sm font-medium text-gray-900">Tipo de
                                        Documento</label>
                                    <select id="tipo_documento" name="tipo_documento"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option selected>Seleccione su tipo de documento</option>
                                        @foreach ($tipodocumento as $id => $nombre)
                                            <option value="{{ $id }}">{{ $nombre }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div>
                                    <label for="numero_documento"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de
                                        Documento</label>
                                    <input type="text" id="numero_documento" name="numero_documento"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Ingrese su numero de documento"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                                </div>
                                <div>
                                    <label for="nombres"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombres</label>
                                    <input type="text" id="nombres" name="nombres"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="ingrese Nombres Completos" />
                                </div>
                                <div>
                                    <label for="apellidos"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellidos</label>
                                    <input type="text" id="apellidos" name="apellidos"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Ingrese sus Apellidos Completos" />
                                </div>
                                <div>
                                    <label for="phone-input"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de
                                        Telefono:</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 19 18">
                                                <path
                                                    d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z" />
                                            </svg>
                                        </div>
                                        <input type="text" id="phone-input" name="telefono"
                                            aria-describedby="helper-text-explanation"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            placeholder="123-456-7890" />
                                    </div>
                                </div>
                                <div>
                                    <label for="rol"
                                        class="block mb-2 text-sm font-medium text-gray-900">Cargos</label>
                                    <select id="rol" name="rol"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option selected>Seleccione su Cargo</option>
                                        @foreach ($roles as $id => $nombre)
                                            <option value="{{ $id }}">{{ $nombre }}</option>
                                        @endforeach

                                    </select>
                                </div>

                            </div>
                            <div class="mb-6 px-4">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo
                                    Electronico - Usuario</label>
                                <input type="email" id="email" name="correo"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="example@company.com" />
                            </div>
                            <div class="mb-6 px-4">
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                                <input type="password" id="password" name="password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="•••••••••" readonly value="" />
                            </div>

                        </div>

                        <!-- Modal footer -->
                        <div
                            class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 p-4 dark:border-white/10">
                            <button type="button"
                                class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-200 focus:bg-primary-accent-200 focus:outline-none focus:ring-0 active:bg-primary-accent-200 dark:bg-primary-300 dark:hover:bg-primary-400 dark:focus:bg-primary-400 dark:active:bg-primary-400"
                                data-twe-modal-dismiss data-twe-ripple-init data-twe-ripple-color="light">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="ms-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
                                data-twe-ripple-init data-twe-ripple-color="light">
                                Gruardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>


    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex justify-end">
                        <button type="button"
                            class=" mb-2 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2"
                            data-twe-toggle="modal" data-twe-target="#nuevoagente" data-twe-ripple-init
                            data-twe-ripple-color="light">
                            <i class="fas fa-user-plus"></i> Crear Nuevo Agente
                        </button>
                    </div>
                    <table id="tableagentes" class="table table-striped" style="width:100%">

                        <thead>
                            <tr>
                                <th>Tipo de Documento</th>
                                <th>Numero de Documento</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>correo</th>
                                <th>estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($personals as $personal)
                                <tr>
                                    <td>{{ $personal->tipodocumento->nombre }}</td>
                                    <td>{{ $personal->numero_documento }}</td>
                                    <td>{{ $personal->nombres }}</td>
                                    <td>{{ $personal->apellidos }}</td>
                                    <td>{{ $personal->correo }}</td>
                                    <td> @switch($personal->estado)
                                            @case(3)
                                                <strong class="text-white bg-green-500 rounded px-2 py-1">
                                                    Activo
                                                </strong>
                                            @break

                                            @case(4)
                                                <strong class="text-white bg-red-500 rounded px-2 py-1">
                                                    Inactivo
                                                </strong>
                                            @break

                                            @default
                                                {{ $personal->estado }}
                                        @endswitch
                                    </td>
                                    <td>
                                        <a href="{{ route('personals.show', $personal->id) }}"
                                            class="inline-block rounded bg-success p-2 text-white uppercase transition duration-150 ease-in-out hover:bg-green-500 focus:outline-none focus:ring-0 active:bg-green-600 mb-1"><i
                                                class="far fa-eye"></i></a>

                                        <a href="{{ route('personals.edit', $personal->id) }}"
                                            class="inline-block rounded bg-warning p-2 text-white uppercase transition duration-150 ease-in-out hover:bg-yellow-500 focus:outline-none focus:ring-0 active:bg-yellow-600"><i
                                                class="far fa-edit"></i></a>
                                        <form action="{{ route('personals.destroy', $personal) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-block rounded bg-danger p-2 text-white uppercase transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none focus:ring-0 active:bg-red-600"><i
                                                    class="far fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @section('js')
        <script>
            document.getElementById('numero_documento').addEventListener('input', function() {
                document.getElementById('password').value = this.value;
            });
        </script>
        <script>
            $(document).ready(function() {
                var table = $('#tableagentes').DataTable({
                    dom: 'frtp',
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

                $('.dt-buttons').addClass('flex justify-end');
            });
        </script>
    @endsection
</x-app-layout>
