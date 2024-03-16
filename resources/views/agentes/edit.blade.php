<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Modificacion Contrato N°:@if ($reporte->contrato)
                {{ $reporte->contrato }}
            @endif
            </h2>
            <a href="{{ route('reportes.index') }}" class="btn btn-primary btn-md flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9.75 14.25 12m0 0 2.25 2.25M14.25 12l2.25-2.25M14.25 12 12 14.25m-2.58 4.92-6.374-6.375a1.125 1.125 0 0 1 0-1.59L9.42 4.83c.21-.211.497-.33.795-.33H19.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25h-9.284c-.298 0-.585-.119-.795-.33Z" />
                </svg> Regresar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!--Tabs navigation-->
                <ul class="mb-5 flex list-none flex-row flex-wrap border-b-0 ps-0" role="tablist" data-twe-nav-ref>
                    <li role="presentation" class="flex-auto text-center">
                        <a href="#tabs-home01"
                            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[twe-nav-active]:border-primary data-[twe-nav-active]:text-primary dark:text-white/50 dark:hover:bg-neutral-700/60 dark:data-[twe-nav-active]:text-primary"
                            data-twe-toggle="pill" data-twe-target="#tabs-home01" data-twe-nav-active role="tab"
                            aria-controls="tabs-home01" aria-selected="true">Informacion</a>
                    </li>
                    <li role="presentation" class="flex-auto text-center">
                        <a href="#tabs-profile01"
                            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[twe-nav-active]:border-primary data-[twe-nav-active]:text-primary dark:text-white/50 dark:hover:bg-neutral-700/60 dark:data-[twe-nav-active]:text-primary"
                            data-twe-toggle="pill" data-twe-target="#tabs-profile01" role="tab"
                            aria-controls="tabs-profile01" aria-selected="false">Fotos</a>
                    </li>
                     </ul>

                <!--Tabs content-->
                <div class="mb-6">
                    <div class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                        id="tabs-home01" role="tabpanel" aria-labelledby="tabs-home-tab01" data-twe-tab-active>
                        <div>
                            <div class="flex flex-col">
                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                        <div class="overflow-hidden px-6">
                                            <form action="{{ route('reportes.update', $reporte) }}" method="post"
                                                enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class="mb-3">
                                                    <input type="text" hidden id="latitud" name="latitud"
                                                        value="">
                                                    <input type="text" hidden id="longitud" name="longitud"
                                                        value="">
                                                    <x-label for='observacion' value='Observacion del Coordinador'
                                                        class="mb-2" />
                                                    <textarea name="observacion" id="observacion" rows="5"
                                                        class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-gray-400"
                                                        readonly>{{ $reporte->observaciones }}</textarea>
                                                    <x-input-error for="observacion" />
                                                </div>
                                                <div class=" mb-3">
                                                    <x-label for='contrato' value='Numero de contrato' class="mb-2" />
                                                    <input type="text"
                                                        class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                        name="contrato" id="contrato"
                                                        placeholder="Ingrese su Numero de Contrato"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                        value="{{ $reporte->contrato }}" readonly>
                                                    <x-input-error for="contrato" />
                                                </div>
                                                <div class=" mb-3">
                                                    <x-label for='lectura' value='Numero de lectura' class="mb-2" />
                                                    <input type="text"
                                                        class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                        name="lectura" id="lectura"
                                                        placeholder="Ingrese su Numero de Lectura"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                        value="{{ $reporte->lectura }}">
                                                    <x-input-error for="lectura" />
                                                </div>
                                                <div class="mb-3">
                                                    <x-label for='anomalia' value='Observacion de Anomalia'
                                                        class="mb-2" />
                                                    <textarea name="anomalia" id="anomalia" rows="5"
                                                        class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                        placeholder="Ingrese su Observacion">{{ $reporte->anomalia }}</textarea>
                                                    <x-input-error for="anomalia" />
                                                </div>
                                                <div class="mb-3">
                                                    <x-label for="obstaculo" value="Imposibilidad de toma de lecturas"
                                                        class="mb-2" />
                                                    <div class="">
                                                        {{-- ninguna --}}
                                                        <div>
                                                            <label for="obstaculo">
                                                                <input type="radio" name="imposibilidad"
                                                                    id="obstaculo" value="ninguna" class="px-2 mb-1"
                                                                    @if ($reporte->imposibilidad === 'ninguna') checked @endif>
                                                                Ninguna
                                                            </label>
                                                        </div>
                                                        {{-- obstaculos --}}
                                                        <div>
                                                            <label for="obstaculo">
                                                                <input type="radio" name="imposibilidad"
                                                                    id="obstaculo" value="obstaculo"
                                                                    class="px-2 mb-1"
                                                                    @if ($reporte->imposibilidad === 'obstaculo') checked @endif>
                                                                Obstaculos
                                                            </label>
                                                        </div>
                                                        {{-- rejas --}}
                                                        <div>
                                                            <label>
                                                                <input type="radio" name="imposibilidad"
                                                                    id="reja" value="reja" class="px-2 mb-1"
                                                                    @if ($reporte->imposibilidad === 'reja') checked @endif>
                                                                Rejas
                                                            </label>
                                                        </div>
                                                        {{-- no medidor --}}
                                                        <div>
                                                            <label>
                                                                <input type="radio" name="imposibilidad"
                                                                    id="medidor" value="medidor" class="px-2 mb-1"
                                                                    @if ($reporte->imposibilidad === 'medidor') checked @endif>
                                                                Sin Medidor
                                                            </label>
                                                        </div>
                                                        {{-- usuario no lectura --}}
                                                        <div>
                                                            <label>
                                                                <input type="radio" name="imposibilidad"
                                                                    id="lectura_m" value="lectura" class="px-2"
                                                                    @if ($reporte->imposibilidad === 'lectura') checked @endif>
                                                                Usuario no Permite Lectura
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="flex flex-wrap gap-2">
                                                        <x-label for="foto1" value="Numero de lectura" />
                                                        <input capture="camera"
                                                            class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                                            id="foto1" name="foto1" type="file" accept="image/*" />
                                                        <x-input-error for="foto1" />

                                                        <x-label for="foto2" value="Numero de Serial" />
                                                        <input capture="camera"
                                                            class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                                            id="foto2" name="foto2" type="file" accept="image/*" />
                                                        <x-input-error for="foto2" />

                                                        <x-label for="foto3" value="Estado del Medidor" />
                                                        <input capture="camera"
                                                            class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                                            id="foto3" name="foto3" type="file" accept="image/*" />
                                                        <x-input-error for="foto3" />

                                                        <x-label for="foto4" value="Numero del Medidor" />
                                                        <input capture="camera"
                                                            class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                                            id="foto4" name="foto4" type="file" accept="image/*" />
                                                        <x-input-error for="foto4" />

                                                        <x-label for="foto5" value="Vivienda" />
                                                        <input capture="camera"
                                                            class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                                            id="foto5" name="foto5" type="file" accept="image/*" />
                                                        <x-input-error for="foto5" />

                                                        <x-label for="foto6" value="Opcional" />
                                                        <input capture="camera"
                                                            class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                                            id="foto6" name="foto6" type="file" accept="image/*" />
                                                        <x-input-error for="foto6" />
                                                    </div>
                                                </div>
                                                <x-button class="mb-3">
                                                    Enviar
                                                </x-button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                        id="tabs-profile01" role="tabpanel" aria-labelledby="tabs-profile-tab01">
                        <div class="container mx-auto px-5 py-2 lg:px-32 lg:pt-10 mb-6">
                            <div class="-m-1 flex flex-wrap md:-m-2">
                                @if ($reporte->foto1)
                                    <div class="w-full lg:w-1/3 p-1 md:p-2">
                                        <img alt="gallery"
                                            class="block h-full w-full rounded-lg object-cover object-center"
                                            src="/imagen/{{ $reporte->foto1 }}" />
                                    </div>
                                @endif
                                @if ($reporte->foto2)
                                    <div class="w-full lg:w-1/3 p-1 md:p-2">
                                        <img alt="gallery"
                                            class="block h-full w-full rounded-lg object-cover object-center"
                                            src="/imagen/{{ $reporte->foto2 }}" />
                                    </div>
                                @endif
                                @if ($reporte->foto3)
                                    <div class="w-full lg:w-1/3 p-1 md:p-2">
                                        <img alt="gallery"
                                            class="block h-full w-full rounded-lg object-cover object-center"
                                            src="/imagen/{{ $reporte->foto3 }}" />
                                    </div>
                                @endif
                                @if ($reporte->foto4)
                                    <div class="w-full lg:w-1/3 p-1 md:p-2">
                                        <img alt="gallery"
                                            class="block h-full w-full rounded-lg object-cover object-center"
                                            src="/imagen/{{ $reporte->foto4 }}" />
                                    </div>
                                @endif
                                @if ($reporte->foto5)
                                    <div class="w-full lg:w-1/3 p-1 md:p-2">
                                        <img alt="gallery"
                                            class="block h-full w-full rounded-lg object-cover object-center"
                                            src="/imagen/{{ $reporte->foto5 }}" />
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
    <script>
        // Función para manejar la obtención de la ubicación actual
        function obtenerUbicacion() {
            navigator.geolocation.getCurrentPosition(function(position) {
                // Obtener latitud y longitud
                var latitud = position.coords.latitude;
                var longitud = position.coords.longitude;

                // Colocar latitud y longitud en los elementos de entrada
                document.getElementById('latitud').value = latitud;
                document.getElementById('longitud').value = longitud;
            });
        }
        // Llamar a la función para obtener la ubicación al cargar la página
        window.onload = obtenerUbicacion;
    </script>
    @endsection
</x-app-layout>
