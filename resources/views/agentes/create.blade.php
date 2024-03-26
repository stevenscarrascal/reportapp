<x-app-layout>
    <x-slot name="header">
        <x-breadcrumb :role="'Coordinador'" :reportTitle="'Creacion de Reportes'" />
        <x-back-button route="{{ route('reportes.index') }}" />
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h1 class="mt-8 text-2xl font-medium text-gray-900 text-center mb-5">
                        TOMA DE LECTURA
                    </h1>
                    <form action="{{ route('reportes.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" hidden id="latitud" name="latitud" value="">
                        <input type="text" hidden id="longitud" name="longitud" value="">
                        <input type="text" hidden name="personal_id" value="{{ Auth::user()->personal->id }}">

                        <div class=" mb-3">
                            <x-label for='contrato' value='Numero de contrato' class="mb-2" />
                            <input type="text"
                                class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                name="contrato" id="contrato" placeholder="Ingrese su Numero de Contrato"
                                value="{{ old('contrato') }}">
                            <x-input-error for="contrato" />
                        </div>
                        <div class=" mb-3">
                            <x-label for='medidor' value='Numero de medidor' class="mb-2" />
                            <input type="text"
                                class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                name="medidor" id="medidor" placeholder="Ingrese su Numero de Medidor"
                                value="{{ old('medidor') }}">
                            <x-input-error for="medidor" />
                        </div>
                        <div class=" mb-3">
                            <x-label for='lectura' value='Numero de lectura' class="mb-2" />
                            <input type="text"
                                class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                name="lectura" id="lectura" placeholder="Ingrese su Numero de Lectura"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('lectura') }}">
                            <x-input-error for="lectura" />
                        </div>
                        <div class=" mb-3">
                            <x-label for='comercio' class="mb-2" value="Tipo de Comercio" />
                            <select id="comercio" name="tipo_comercio"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-3">
                                <option selected>Seleccione tipo de Comercio</option>
                                @foreach ($comercios as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                @endforeach
                            </select>

                            <x-input-error for="comercio" />
                            <!-- Añade aquí tu input -->
                            <input id="input-comercio" placeholder="Ingrese el tipo de Comercio" name="tipo_Comercio"
                                type="text" hidden
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  w-full p-2.5  " />
                        </div>
                        <div class=" mb-3">
                            <label for="anomalia"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Opciones de
                                Anomalia</label>
                            <select id="anomalia" name="anomalia"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Seleccione Su Anomalia</option>
                                @foreach ($anomalias as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="anomalia" />
                        </div>
                        <div class="mb-4">
                            <label for="obstaculos" class="mb-4">Imposibilidad de toma de
                                Lectura</label>
                            <div class="mb-3">
                                <select id="obstaculos" name="imposibilidad"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Selecione su inposibilidad</option>
                                    @foreach ($imposibilidad as $id => $nombre)
                                        <option value="{{ $id }}">{{ $nombre }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="anomalia" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <div id="video_evidencia" class=" hidden mb-3">
                                <label for="video" class="file-label">Video evidencia de anomalia
                                    <input capture="camera"
                                        class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                        id="video" name="video" type="file" accept="video/*"
                                        aria-describedby="file_input_help7" />
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_video">
                                        MP4, WebM, QuickTime, AVI, MPEG, WMV .</p>
                                    <x-input-error for="video" />
                                </label>
                            </div>
                            <div id="fotos_inmueble">
                                <label for="foto1" class="file-label">Foto del inmueble
                                    <input capture="camera"
                                        class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                        id="foto1" name="foto1" type="file" accept="image/*"
                                        aria-describedby="file_input_help1" />
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help1">
                                        SVG,
                                        PNG, JPG or GIF (MAX. 800x400px).</p>
                                    <x-input-error for="foto1" />
                                </label>
                            </div>
                            <div class=" flex-wrap gap-2 hidden" id="fotos_evidencia">
                                <label for="foto2" class="file-label">Numero de Serial
                                    <input capture="camera"
                                        class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                        id="foto2" name="foto2" type="file" accept="image/*"
                                        aria-describedby="file_input_help" />
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help2">
                                        SVG,
                                        PNG, JPG or GIF (MAX. 800x400px).</p>
                                    <x-input-error for="foto2" />
                                </label>
                                <label for="foto3" class="file-label">Numero de Lectura
                                    <input capture="camera"
                                        class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                        id="foto3" name="foto3" type="file" accept="image/*"
                                        aria-describedby="file_input_help" />
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help3">
                                        SVG,
                                        PNG, JPG or GIF (MAX. 800x400px).</p>
                                    <x-input-error for="foto3" />
                                </label>
                                <label for="foto4" class="file-label">Numero del medidor
                                    <input capture="camera"
                                        class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                        id="foto4" name="foto4" type="file" accept="image/*"
                                        aria-describedby="file_input_help" />
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help4">
                                        SVG,
                                        PNG, JPG or GIF (MAX. 800x400px).</p>
                                    <x-input-error for="foto4" />
                                </label>
                                <label for="foto5" class="file-label">Estado del Medidor
                                    <input capture="camera"
                                        class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                        id="foto5" name="foto5" type="file" accept="image/*"
                                        aria-describedby="file_input_help" />
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help5">
                                        SVG,
                                        PNG, JPG or GIF (MAX. 800x400px).</p>
                                    <x-input-error for="foto5" />
                                </label>
                                <label for="foto6" class="file-label">Opcional
                                    <input capture="camera"
                                        class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                        id="foto6" name="foto6" type="file" accept="image/*"
                                        aria-describedby="file_input_help" />
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help6">
                                        SVG,
                                        PNG, JPG or GIF (MAX. 800x400px).</p>
                                    <x-input-error for="foto6" />
                                </label>

                            </div>
                        </div>
                        <x-button>
                            Enviar
                        </x-button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    @section('js')
        {{-- This script adds an event listener to the 'anomalia' element and toggles the visibility of the 'video_evidencia' element based on the selected value.
          @param {Event} event - The event object. --}}
        <script>
            document.getElementById('anomalia').addEventListener('change', function(event) {
                var anomalia = document.getElementById('video_evidencia');

                if (this.value == '8') {
                    anomalia.classList.add('hidden');

                } else {
                    Swal.fire({
                        title: "Anomalia?",
                        text: "Debes Subir el Video de Evidencia de la Anomalia",
                        icon: "question"
                    });
                    anomalia.classList.remove('hidden');


                }
            });
        </script>

        <script>
            document.getElementById('obstaculos').addEventListener('change', function() {
                var anomalia = document.getElementById('fotos_evidencia');

                if (this.value == '48') {
                    anomalia.classList.remove('hidden');
                } else {
                    anomalia.classList.add('hidden');
                }
            });
        </script>

        <script>
            function validate(id, x) {
                var fileInputHelp = document.getElementById(id);

                if (x.files && x.files[0]) {
                    fileInputHelp.textContent = 'Archivo cargado';
                    fileInputHelp.classList.add('text-green-500');
                } else {
                    fileInputHelp.textContent = 'SVG, PNG, JPG or GIF (MAX. 800x400px).';
                    fileInputHelp.classList.remove('text-green-500');
                }
            }

            document.getElementById('foto1').addEventListener('change', function() {
                validate('file_input_help1', this);
            });

            document.getElementById('foto2').addEventListener('change', function() {
                validate('file_input_help2', this);
            });

            document.getElementById('foto3').addEventListener('change', function() {
                validate('file_input_help3', this);
            });

            document.getElementById('foto4').addEventListener('change', function() {
                validate('file_input_help4', this);
            });

            document.getElementById('foto5').addEventListener('change', function() {
                validate('file_input_help5', this);
            });

            document.getElementById('foto6').addEventListener('change', function() {
                validate('file_input_help6', this);
            });
            document.getElementById('video').addEventListener('change', function() {
                validate('file_input_video', this);
            });
        </script>

        <script>
            document.getElementById('comercio').addEventListener('change', function() {
                var inputComercio = document.getElementById('input-comercio');

                if (this.value == '45') {
                    inputComercio.hidden = false;
                    inputComercio.name = "tipo_comercio";
                    this.name = "";
                } else {
                    inputComercio.hidden = true;
                    inputComercio.name = "";
                    this.name = "tipo_comercio";
                }
            });
        </script>

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
