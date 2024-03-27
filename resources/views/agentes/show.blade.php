<x-app-layout>
    <x-slot name="header">
        <x-breadcrumb :role="'Coordinador'" :reportTitle="'Reportes Activos'" />
        <a href="{{ route('reportes.index') }}"
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
                        <div class="mb-2">
                            <h1 class="mb-2 text-base">Anomalia Detectada</h1>
                            <ul>
                                @foreach ($anomalias as $anomalia)
                                    <li>{{ $anomalia->nombre }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <p class="mb-3 text-base">Imposibilidad: {{ $reporte->imposibilidadReporte->nombre }} </p>
                        <h3 class="mb-2 mt-3 text-xl text-center font-medium leading-tight">Observaciones</h3>
                        <p class="mb-4 text-base"> {{ $reporte->observaciones }}</p>

                    </div>
                    <div class="px-5 py-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            @foreach (range(1, 6) as $i)
                                @if ($reporte->{'foto' . $i})
                                    <div class="relative">
                                        <img alt="gallery" class="h-auto max-w-full rounded-lg"
                                            src="/imagen/{{ $reporte->{'foto' . $i} }}" />
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
                        <div class="w-full">
                            <video width="50%" height="50%" controls>
                                <source src="{{ asset('video/' . $reporte['video']) }}" type="video/mp4">
                                Tu navegador no soporta el elemento de video.
                            </video>
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
                    img.style.cursor = 'pointer'; // Cambiar el cursor a un puntero de mano

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
