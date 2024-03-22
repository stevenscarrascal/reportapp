<x-app-layout>
    <x-slot name="header">
        <x-breadcrumb :role="'Coordinador'" :reportTitle="'Reportes Activos'" />
        <a href="{{ route('coordinador.index') }}"
            class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none mb-2">
            <i class="fas fa-arrow-left"></i> Regresar
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                    {{-- Tarjeta --}}
                    <div
                        class="block mb-3 py-3  m-4 rounded-lg bg-white p-6 text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-white">
                        <h2 class="mb-2 text-lg text-center font-semibold ">Numero de Contrato: {{ $reporte->contrato }}
                        </h2>
                        <p class="mb-2 text-base">Lectura N°: {{ $reporte->lectura }}</p>
                        <p class="mb-2 text-base">Fecha y Hora: {{ $reporte->created_at }}</p>
                        <p class="mb-2 text-base">Direccion: {{ $reporte->direccion }}</p>
                        <p class="mb-2 text-base">Anomalia Detectada: {{ $reporte->AnomaliaReporte->nombre }}</p>
                        <p class="mb-3 text-base ">Imposibilidad: {{ $reporte->imposibilidadReporte->nombre }} </p>
                        <h3 class="mb-2 mt-3 text-xl text-center font-medium leading-tight">Observaciones</h3>
                        <p class="mb-4 text-base"> {{ $reporte->observaciones }}</p>
                        @if ($reporte->estado == 5 || $reporte->estado == 7)
                            <form action="{{ route('coordinador.update', $reporte) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="text" name="estado" value="" hidden>
                                <div
                                    class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                    <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                                        <textarea id="comment" rows="4" name="observaciones"
                                            class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                            placeholder="Escriba su observacion" @if ($reporte->estado == 6) readonly @endif>
                                        </textarea>
                                    </div>
                                    @if ($reporte->estado == 5)
                                        <div class="flex items-center gap-2 px-3 py-2 border-t">
                                            <button type="submit"
                                                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 hover:bg-blue-800">
                                                Enviar
                                            </button>
                                            <div class="mb-[0.125rem] block min-h-[1.5rem] ps-[1.5rem]">
                                                <input
                                                    class="relative float-left -ms-[1.5rem] me-1 mt-0.5 h-5 w-5 appearance-none rounded-full border-2 border-solid border-secondary-500 before:pointer-events-none before:absolute before:h-4 before:w-4 before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-checkbox before:shadow-transparent before:content-[''] after:absolute after:z-[1] after:block after:h-4 after:w-4 after:rounded-full after:content-[''] checked:border-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:left-1/2 checked:after:top-1/2 checked:after:h-[0.625rem] checked:after:w-[0.625rem] checked:after:rounded-full checked:after:border-primary checked:after:bg-primary checked:after:content-[''] checked:after:[transform:translate(-50%,-50%)] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-black/60 focus:shadow-none focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-black/60 focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:border-primary checked:focus:before:scale-100 checked:focus:before:shadow-checkbox checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] rtl:float-right dark:border-neutral-400 dark:checked:border-primary"
                                                    type="radio" name="estado" id="radioDefault01" value="7" />
                                                <label class="mt-px inline-block ps-[0.15rem] hover:cursor-pointer"
                                                    for="radioDefault01">
                                                    Rechazado
                                                </label>
                                            </div>
                                            <div class="mb-[0.125rem] block min-h-[1.5rem] ps-[1.5rem]">
                                                <input
                                                    class="relative float-left -ms-[1.5rem] me-1 mt-0.5 h-5 w-5 appearance-none rounded-full border-2 border-solid border-secondary-500 before:pointer-events-none before:absolute before:h-4 before:w-4 before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-checkbox before:shadow-transparent before:content-[''] after:absolute after:z-[1] after:block after:h-4 after:w-4 after:rounded-full after:content-[''] checked:border-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:left-1/2 checked:after:top-1/2 checked:after:h-[0.625rem] checked:after:w-[0.625rem] checked:after:rounded-full checked:after:border-primary checked:after:bg-primary checked:after:content-[''] checked:after:[transform:translate(-50%,-50%)] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-black/60 focus:shadow-none focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-black/60 focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:border-primary checked:focus:before:scale-100 checked:focus:before:shadow-checkbox checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] rtl:float-right dark:border-neutral-400 dark:checked:border-primary"
                                                    type="radio" name="estado" id="radioDefault02" value="6"
                                                    checked />
                                                <label class="mt-px inline-block ps-[0.15rem] hover:cursor-pointer"
                                                    for="radioDefault02">
                                                    Revisado
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <p class="ms-auto text-xs text-gray-500">Aqui podra colocar Las observaciones referentes
                                    a esta lectura</p>
                            </form>
                        @endif
                    </div>
                    <div class="px-5 py-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach (range(1, 6) as $i)
                                @if ($reporte->{'foto' . $i})
                                    <div class="relative">
                                        <img alt="gallery" class="h-auto max-w-full rounded-lg" src="/imagen/{{ $reporte->{'foto' . $i} }}" />
                                        <div class="absolute top-0 left-0 bg-black bg-opacity-50 text-white p-2">
                                            @switch($i)
                                            @case(1)
                                            <p class="text-sm">Foto del inmueble</p>
                                                @break
                                            @case(2)
                                            <p class="text-sm">Numero del Serial</p>
                                                @break
                                            @case(3)
                                            <p class="text-sm">Numero de Lectura</p>
                                                @break
                                            @case(4)
                                            <p class="text-sm">Numero del Medidor</p>
                                                @break
                                            @case(5)
                                            <p class="text-sm">Estado del Medidor</p>
                                                @break
                                            @case(6)
                                            <p class="text-sm">Opcional</p>
                                                @break
                                        @endswitch
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @section('css')
            <style>
                .modal {
                    transition: background-color 0.7s ease;
                }
            </style>
        @endsection
        @section('js')
        <script>
            document.querySelectorAll('.grid img').forEach(img => {
                img.addEventListener('click', function() {
                    openModal(this.src);
                });
            });

            function openModal(imageSrc) {
                // Crear el modal
                let modal = document.createElement('div');
                modal.classList.add('modal');
                modal.style.display = 'flex';
                modal.style.position = 'fixed';
                modal.style.zIndex = '1000';
                modal.style.left = '0';
                modal.style.top = '0';
                modal.style.width = '100%';
                modal.style.height = '100%';
                modal.style.overflow = 'auto';
                modal.style.backgroundColor = 'rgba(0,0,0,0)';
                modal.style.justifyContent = 'center';
                modal.style.alignItems = 'center';

                // Crear la imagen
                let img = document.createElement('img');
                img.src = imageSrc;
                img.style.display = 'block';
                img.style.margin = 'auto';
                img.style.maxWidth = '80%';
                img.style.maxHeight = '80%';
                img.style.borderRadius = '10px'; // Agregar bordes redondeados a la imagen

                // Agregar la imagen al modal
                modal.appendChild(img);

                // Agregar el modal al body
                document.body.appendChild(modal);

                // Cambiar la opacidad del modal a 1 para mostrarlo
                setTimeout(function() {
                    modal.style.backgroundColor = 'rgba(0,0,0,0.4)';
                }, 0);

                // Cerrar el modal cuando se hace clic en él
                modal.addEventListener('click', function() {
                    modal.style.backgroundColor = 'rgba(0,0,0,0)';
                    setTimeout(function() {
                        modal.style.display = 'none';
                    }, 200);
                });
            }
        </script>
        @endsection
</x-app-layout>
