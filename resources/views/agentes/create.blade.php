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
                    <form action="{{ route('reportes.store') }}" method="post" enctype="multipart/form-data"
                        id="myForm">
                        @csrf
                        <input type="text" hidden id="latitud" name="latitud" value="">
                        <input type="text" hidden id="longitud" name="longitud" value="">

                        <div class=" mb-3">
                            <x-label for='contrato' value='Numero de contrato' class="mb-2" />
                            <input type="text" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                name="contrato" id="contrato" placeholder="Ingrese su Numero de Contrato"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('contrato') }}"
                                inputmode="numeric">
                            <x-input-error for="contrato" />
                        </div>
                        <div class=" mb-3">
                            <x-label for='medidor' value='Numero de medidor' class="mb-2" />
                            <input type="text" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                name="medidor" id="medidor" placeholder="Ingrese su Numero de Medidor"
                                value="{{ old('medidor') }}">
                            <x-input-error for="medidor" />
                            <div class="flex items-center mt-2 ">
                                <input id="link" type="checkbox" value=""
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="link"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 mr-2">Medidor No
                                    Concuerda</label>
                                    <input id="cambio" type="checkbox" value=""
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="cambio"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cambio de Medidor</label>
                            </div>
                            <div id="medidor_anomalia" class="mt-2 hidden">
                                <x-label for='medidor2' value='Numero de medidor que No Concuerda' class="mb-2" />
                                <input type="text"
                                    class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 "
                                    name="medidor_anomalia" id="medidor_anomalia"
                                    placeholder="Ingrese su Numero de Medidor" value="{{ old('medidor_anomalia') }}">
                                <x-input-error for="medidor_anomalia" />
                            </div>
                            <div id="medidor_cambio" class="mt-2 hidden">
                                <x-label for='medidor_cambio' value='Motivo del Cambio de medidor' class="mb-2" />
                                <input type="text"
                                    class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 "
                                    name="medidor_cambio" id="medidor_cambio"
                                    placeholder="Observaciones " value="{{ old('medidor_anomalia') }}">
                                <x-input-error for="medidor_cambio" />
                            </div>

                        </div>
                        <div class=" mb-3">
                            <x-label for='lectura' value='Numero de lectura' class="mb-2" />
                            <input type="text" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                name="lectura" id="lectura" placeholder="Ingrese su Numero de Lectura"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('lectura') }}"
                                inputmode="numeric">
                            <x-input-error for="lectura" />
                        </div>
                        <div class=" mb-3">
                            <x-label for='comercio' class="mb-2" value="Tipo de Comercios" />
                            <select id="comercio" name="tipo_comercio" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-3">
                                <option selected value="" disabled>Seleccione tipo de Comercio</option>
                                @foreach ($comercios as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="comercio" />
                            <div id="div-comercio-nuevo" style="display: none;" class=" flex">
                                <input type="text" name="nuevo_comercio" id="nueva_opcion"
                                    class="w-1/2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            </div>
                        </div>
                        <div class=" mb-3">
                            <label for="anomalia"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Opciones de
                                Anomalia</label>
                            <select id="anomalia" name="anomalia[]" multiple="multiple" required
                                class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-3"
                                placeholder="Seleccione su Anomalia">
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
                                <select id="obstaculos" name="imposibilidad" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected value="" disabled>Selecione su imposibilidad</option>
                                    @foreach ($imposibilidad as $id => $nombre)
                                        <option value="{{ $id }}">{{ $nombre }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="obstaculos" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="mb-3">
                                <label for="comentarios"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observaciones</label>
                                <textarea id="comentarios" name="comentarios" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                <x-input-error for="comentarios" />
                            </div>
                        </div>
                        <div class="mb-3">
                            {{-- <div id="video_evidencia" class=" hidden mb-3">
                                <label for="foto7" id="label_help7"
                                    class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                    </svg>
                                    <h2
                                        class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                        Video de Anomalia</h2>
                                    <p id="elemento_7"
                                        class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                        sube tu video en formato MP4 </p>
                                    <input id="foto7" name="video" type="file" class="hidden"
                                        accept="video/*" />
                                </label>
                            </div> --}}
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Elemento 1 -->
                                <div>
                                    <div>
                                        <label for="foto1" id="label_help1"
                                            class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                            </svg>
                                            <h2
                                                class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                Foto del Inmueble</h2>
                                            <p id="elemento_1"
                                                class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                sube la foto en formato JPEG </p>
                                            <input id="foto1" name="foto1" type="file" class="hidden"
                                                accept="image/*" capture="camera" />
                                            <x-input-error for="foto1" />
                                        </label>
                                    </div>
                                </div>
                                <!-- Elemento 2 -->
                                <div>
                                    <div>
                                        <label for="foto2" id="label_help2"
                                            class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                            </svg>
                                            <h2
                                                class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                Numero de Serial</h2>

                                            <p id="elemento_2"
                                                class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                Realiza la foto en formato JPEG </p>

                                            <input id="foto2" name="foto2" type="file" class="hidden"
                                                capture="camera" accept="image/*" />
                                        </label>
                                    </div>
                                </div>
                                <!-- Elemento 3 -->
                                <div>
                                    <div>
                                        <label for="foto3" id="label_help3"
                                            class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                            </svg>
                                            <h2
                                                class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                Numero de Lectura</h2>

                                            <p id="elemento_3"
                                                class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                Realiza la foto en formato JPEG </p>

                                            <input id="foto3" name="foto3" type="file" class="hidden"
                                                capture="camera" accept="image/*" />
                                        </label>
                                    </div>
                                </div>
                                <!-- Elemento 4 -->
                                <div>
                                    <div>
                                        <label for="foto4" id="label_help4"
                                            class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                            </svg>
                                            <h2
                                                class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                Numero del Medidor</h2>

                                            <p id="elemento_4"
                                                class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                Realiza la foto en formato JPEG </p>

                                            <input id="foto4" name="foto4" type="file" class="hidden"
                                                capture="camera" accept="image/*" />
                                        </label>
                                    </div>
                                </div>
                                <!-- Elemento 5 -->
                                <div>
                                    <div>
                                        <label for="foto5" id="label_help5"
                                            class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                            </svg>
                                            <h2
                                                class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                Estado del Medidor</h2>

                                            <p id="elemento_5"
                                                class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                Realiza la foto en formato JPEG </p>

                                            <input id="foto5" name="foto5" type="file" class="hidden"
                                                capture="camera" accept="image/*" />
                                        </label>
                                    </div>
                                </div>
                                <!-- Elemento 6 -->
                                <div>
                                    <div>
                                        <label for="foto6" id="label_help6"
                                            class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                            </svg>
                                            <h2
                                                class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                Opcional</h2>

                                            <p id="elemento_6"
                                                class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                Realiza la foto en formato JPEG </p>

                                            <input id="foto6" name="foto6" type="file" class="hidden"
                                                capture="camera" accept="image/*" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <button type="submit" id="submitButtonEvidencias"
                                class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Enviar</button>
                            <div class="d-flex hidden w-full" role="alert" id="progressBarEvidencias">
                                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 flex items-center w-full"
                                    role="alert">
                                    <div role="status" class="flex items-center">
                                        <svg aria-hidden="true"
                                            class="inline w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-green-600"
                                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="currentColor" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentFill" />
                                        </svg>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <span class="font-medium ml-4">Cargando Archivos!! Esto Puede demorar unos Minutos
                                        Espere...</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('js')
        <script>
            document.getElementById("comercio").addEventListener("change", function() {
                var divComercioNuevo = document.getElementById("div-comercio-nuevo");
                if (this.value == "56") {
                    divComercioNuevo.style.display = "block";
                } else {
                    divComercioNuevo.style.display = "none";
                }
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#myForm').submit(function(e) {
                    $('#submitButtonEvidencias').addClass('hidden');
                    $('#progressBarEvidencias').removeClass('hidden');
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>

        {{-- <script>
            $(document).ready(function() {
                var alertShown = false; // Variable de control

                $('#anomalia').on('select2:select', function(e) {
                    var anomalia = document.getElementById('video_evidencia');
                    var values = $(this).val();

                    if (values.includes('8')) {
                        anomalia.classList.add('hidden');
                        alertShown = false; // Resetea la variable de control cuando se selecciona '8'
                    } else if (!alertShown) { // Solo muestra el alerta si no se ha mostrado antes
                        Swal.fire({
                            title: "Anomalia?",
                            text: "Debes Subir el Video de Evidencia de la Anomalia",
                            icon: "question"
                        });
                        anomalia.classList.remove('hidden');
                        alertShown =
                            true; // Marca la variable de control como verdadera después de mostrar el alerta
                    }
                });
            });
        </script> --}}

        <script>
            for (let i = 1; i <= 7; i++) {
                const fileInput = document.getElementById(`foto${i}`);
                const fileInputHelp = document.getElementById(`elemento_${i}`);
                const labelHelp = document.getElementById(`label_help${i}`);
                const originalText = fileInputHelp.innerText;

                fileInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        fileInputHelp.innerText = 'Archivo cargado.';
                        fileInputHelp.style.color = 'white';
                        labelHelp.classList.remove('bg-white');
                        labelHelp.classList.add('bg-green-500');
                    } else {
                        fileInputHelp.innerText = originalText;
                        fileInputHelp.style.color = 'initial';
                        labelHelp.classList.remove('bg-green-500');
                        labelHelp.classList.add('bg-white');
                    }
                });
            }
        </script>

        <script>
            function obtenerUbicacion() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        // Obtener latitud y longitud
                        var latitud = position.coords.latitude;
                        var longitud = position.coords.longitude;

                        // Colocar latitud y longitud en los elementos de entrada
                        document.getElementById('latitud').value = latitud;
                        document.getElementById('longitud').value = longitud;
                    }, function(error) {
                        // Manejar los errores
                        switch (error.code) {
                            case error.PERMISSION_DENIED:
                                alert("El usuario no permitió la solicitud de geolocalización.");
                                break;
                            case error.POSITION_UNAVAILABLE:
                                alert("La información de ubicación no está disponible.");
                                break;
                            case error.TIMEOUT:
                                alert("La solicitud para obtener la ubicación del usuario ha expirado.");
                                break;
                            case error.UNKNOWN_ERROR:
                                alert("Ha ocurrido un error desconocido.");
                                break;
                        }
                    });
                } else {
                    alert("Geolocalización no es soportada por este navegador.");
                }
            }

            // Llamar a la función para obtener la ubicación al cargar la página
            window.onload = obtenerUbicacion;
        </script>

        <script>
            document.getElementById('link').addEventListener('change', function() {
                var medidorAnomalia = document.getElementById('medidor_anomalia');
                if (this.checked) {
                    medidorAnomalia.classList.remove("hidden");
                } else {
                    medidorAnomalia.classList.add("hidden");
                }
            });
        </script>

<script>
    document.getElementById('cambio').addEventListener('change', function() {
        var medidorAnomalia = document.getElementById('medidor_cambio');
        if (this.checked) {
            medidorAnomalia.classList.remove("hidden");
        } else {
            medidorAnomalia.classList.add("hidden");
        }
    });
</script>
    @endsection

</x-app-layout>
